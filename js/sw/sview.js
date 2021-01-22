var svTransitionEnd = 'webkitTransitionEnd otransitionend oTransitionEnd msTransitionEnd transitionend';

/**
 * @class StoryViewFlagger
 * @desc --
 * @param {} view -
 */
function StoryViewFlagger() {
  this.fired = false;
  this.set = function() {
    this.fired = true;
  }
  return this;
}

/**
 * @class StoryView
 * @desc --
 * @param {} view -
 */
function StoryView( options ) {
  var closeIcon = 'data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAYCAQAAABKfvVzAAAAAmJLR0QA/4ePzL8AAABwSURBVDiN3ZJLDoAgDES5hESOCMe1C4/z3Jgo6fBbahckTObRDw3hV0EmSj2SlVwA8wgRA4oHNg7gJEl1Vzkc0rV7ZGivkSn7q0m7Tzk3nWXmdQeksXu1pKdV/S9Ne3VrIX6QXUTPvYMsL9/yen84LvAGzq7yBlGMAAAAAElFTkSuQmCC';
  var fsvTemplate = [
    '<div class="sv-view">',
      '<span class="close"><img src="'+ ( options.closeIcon || closeIcon ) +'" /></span>',
      '<div class="loading"><span></span></div>',
      '<span class="profile">',
        '<div class="image"></div>',
        '<span class="name"></span>',
      '</span>',
      '<div class="content"><div class="media-container"></div><div class="media-text"></div></div>',
    '</div>'
  ];
  this.options = options;
  this.itemSelector = '.story-view-item';
  this.fsvTemplate = fsvTemplate.join('\n');
  this.container = $( options.container );
  this.reset();
  this.init();
}

StoryView.prototype.Helpers = {

  /**
  * @desc
  * @param {} element -
  */
  getBackground: function( element ) {
    var bg = element.css( 'background-image' );
    return bg.replace(/.*\s?url\([\'\"]?/, '').replace(/[\'\"]?\).*/, '')
  },

  /**
  * @desc
  * @param {} element -
  */
  isTouchDevice: function() {
    return 'ontouchstart' in window || 'onmsgesturechange' in window;
  },

  /**
  * @desc
  */
  generateID: function() {
   return "x".split( '-' ).map( function( x ) {
     return x.replace( x, Math.random().toString( 16 ).substring( 2 ) + Date.now().toString( 16 ) )
   }).join( '-' );
  },

  /**
  * @desc
  */
  containerPositon: function() {
    var container = this.storyContainer
      , matrix;

    matrix = container.css( 'transform' ).split( ',' ).map( function( val ) {
      return parseFloat( val.replace( /[a-z\s()]/g, '' ) )
    });

    return {
      x: matrix[ 4 ],
      y: matrix[ 5 ]
    }
  },

  /**
  * @desc
  */
  oneTimeFire: function( callback ) {
    var flagger = false;
    return function( event ) {
      if( !flagger ) callback( event );
      flagger = true;
    }
  }
}



/**
 * @desc
 *
 */
StoryView.prototype.reset = function() {
  this.stories = [];
  this.mediaItems = [];
  this.mask = null;
  this.view = null;
  this.storyContainer = null;
  this.currentStory = null;
  this.currentMediaProgress = null;
  this.currentMedia = 0;
  this.paused = false;
  this.lastProgressVal = null;
  this.removingState = false;
  this.lastTouchStartTime = null;
  this.mediaLoading = false;
  this.mediaStartTime = null;
  this.mediaTempItem = null;
  this.mediaTempLoadFn = null;
  this.gestureStartOffset = null;
  this.elements = {};
  if( this.hammer ) this.hammer.destroy();
  this.hammer = null;
}

/**
 * @desc
 *
 */
StoryView.prototype.init = function() {
  this.getItems();
};

/**
 * @desc
 *
 */
StoryView.prototype.getItems = function() {
  var items = this.container.find( this.itemSelector );

  // Get all story items in view
  // #
  items.each( function( idx, item ) {
    var $item = $( item );

    /**
     * [ jQuery Event: click --> $item ]
     */
    $item.on( 'click', this.storyClick.bind( this, $item ) );

    $item.data( 'has-next', idx != items.length -1 ? true : false );
    $item.data( 'profile-image', $item.data( 'profile-image' ) );
    $item.data( 'profile-name', $item.data( 'profile-name' ) );
    this.stories.push( $item );
  }.bind( this ));
}

/**
 * @desc
 * @param {} story -
 */
StoryView.prototype.storyClick = function( story ) {
  if( story.hasClass( 'activated' ) ) return;
  this.removingState = false;
  this.openStory( story );
}

/**
 * @desc
 * @param {} x -
 */
StoryView.prototype.changeMediaByGesture = function ( x, type ) {
  var wv = $( window ).width();

  // Get next media
  // #
  if( x > wv / 2 ) {
    this.nextMedia( true );
  }

  // Get previous media
  // #
  if( x < wv / 2 ) {
    this.prevMedia( true );
  }
};


/**
 * @desc
 * @param {} event -
 */
StoryView.prototype.storyViewMouse = function( event ) {
    var diff
      , evX = event.clientX || ( event.changedTouches && event.changedTouches[ 0 ].clientX )
      , evType = event.type;

  // Detecting pause state
  // #
  if( evType == 'touchstart' || evType == 'mousedown' )
    this.lastTouchStartTime = Date.now();

  if( evType == 'touchend' || evType == 'mouseup' )
    diff = Date.now() - this.lastTouchStartTime;

  if( !diff ) {
    this.paused = true;
    return;
  }
  else this.paused = false;

  if( ( evType == 'touchend' || evType == 'mouseup' ) && diff < 400 ) {
    this.changeMediaByGesture( evX, event.type );
  }
}

/**
 * @desc
 * @param {} event -
 */
StoryView.prototype.gestureVertical = function( event ) {

  var pos;

  if( typeof this.gestureStartOffset.y == 'undefined' )
    return;

  //
  // #
  if( event.direction == Hammer.DIRECTION_UP ) {
    pos = this.gestureStartOffset.y + event.deltaY;
  }

  //
  // #
  if( event.direction == Hammer.DIRECTION_DOWN ) {
    pos = this.gestureStartOffset.y + event.deltaY;
  }

  if( pos < 0 ) pos = 0

  this.storyContainer.removeClass( 'transition' );
  this.storyContainer.css( 'transform', 'translateY( '+ pos +'px )' );
}

/**
 * @desc
 * @param {} event -
 */
StoryView.prototype.gestureStartStop = function( event ) {

  var containerPosition = this.Helpers.containerPositon.call( this );

  if( event.type == 'swipedown' ) {
    this.mask.addClass( 'swipe-close' );
    this.closeView()
    return;
  }

  // Start
  // #
  if( event.type == 'panstart' ) {
    this.gestureStartOffset = { x: containerPosition.x, y: containerPosition.y };
  }

  // Stop
  // #
  if( event.type == 'panend' ) {
    this.storyContainer.addClass( 'transition' ).css( 'transform', 'translateY( 0 )' );

  }
}

/**
 * @desc
 *
 */
StoryView.prototype.preserveProfileName = function() {
  this.elements.profile.find( '.name' ).css( 'min-width',
    this.elements.profile.find( '.name' ).width()
  );
}


/**
 * @desc
 * @param {} mediaIndex -
 */
StoryView.prototype.closeView = function() {
  if( this.removingState ) return;

  var that = this
    , t1, t2;

  this.removingState = true;
  this.view.removeClass( 'open' );

  t1 = setTimeout( function() {
    clearTimeout( t1 );
    this.view.addClass( 'removing' );
  }.bind( this ), 100 );

  this.preserveProfileName();

  /*
   *
   *
   * [ jQuery Event: one --> this.view ]
   */
   this.view.one( svTransitionEnd, new this.Helpers.oneTimeFire( function( event ) {

     this.view.removeClass( 'move' )
     this.mask.removeClass( 'open' )
     this.currentStory.removeClass( 'activated' );

     t2 = setTimeout( function() {
       clearTimeout( t2 );
       this.mask.remove();
       this.view.remove();
       this.storyContainer.remove();
       this.currentStory.removeClass( 'activated' );
       clearTimeout( this.currentMediaProgress );
       this.reset();
       $( 'body' ).removeClass( 'story-view--shown' );
     }.bind( this ), 100 );
   }.bind( this )));
}

/**
 * @desc
 * @param {} story -
 * @param isNextStory -
 */
StoryView.prototype.openStory = function( story, isNextStory, mediaIndex ) {
  var that = this;

  this.view = this.view || $( this.fsvTemplate );
  this.storyContainer = this.storyContainer || $( '<div />' );

  var background = this.Helpers.getBackground( story )
    , fsLeft = story.position().left
    , fsTop = story.position().top - $( window ).scrollTop()
    , hammerPan, hammerSwipe
    , t1, t2;

  this.view.css({
    transform: 'translateX( '+ fsLeft +'px) translateY( '+ fsTop +'px )',
    width: story.width(),
    height: story.height()
  });

  if( !isNextStory ) {
    this.mask = $( '<div class="sv-mask" />' );

    // Create hammer instance
    // #
    this.hammer = new Hammer.Manager( this.view.get( 0 ) );

    hammerPan = new Hammer.Pan({
      direction: Hammer.DIRECTION_ALL,
      threshold: 0
    });

    hammerSwipe = new Hammer.Swipe({
      direction: Hammer.DIRECTION_DOWN,
      threshold: 10,
      velocity: 1.5
    });

    hammerSwipe.recognizeWith( hammerPan );

    this.hammer.add( hammerPan );
    this.hammer.add( hammerSwipe );

    this.elements = {
      mediaContainer: this.view.find( '.media-container' ),
      loading: this.view.find( '.loading' ),
      profile: this.view.find( '.profile' )
    };

    this.storyContainer.attr( 'id', 'sv-' + this.Helpers.generateID() );
    this.storyContainer.attr( 'class', 'sv-container' );
    this.storyContainer.append( this.view );
    this.storyContainer.append( this.mask );
    $( 'body' ).append( this.storyContainer ); 

    /**
     *
     * [ jQuery Event: [ click ] --> view .close ]
     */
    this.view.find( '.close' ).on( 'click touchend', function() {
      that.closeView();
    });

    /**
     *
     * [ jQuery event: [ mousedown mouseup touchstart touchend ] --> view ]
     */
    var eventList = 'mousedown mouseup touchstart touchend';
    this.view.on( eventList, function( event ) {
      event.preventDefault();

      var $target = $( event.target );
      if( $target.parents( '.close' ).length == 0 )
        that.storyViewMouse( event );
    });

    /**
     *
     *
     * [ HammerJs event:  ]
     */
    this.hammer.on( 'swipedown panstart panend', this.gestureStartStop.bind( this ) );
    this.hammer.on( 'pandown panup', this.gestureVertical.bind( this ) );

  }

  // Reset container position
  // #
  this.storyContainer.css( 'transform', 'translate( 0, 0 )' );

  // Reset profile on new story
  // #
  this.elements.profile.removeClass( 'show' );
  // this.elements.profile.find( '.image' ).removeAttr( 'style' );
  // this.elements.profile.find( '.name' ).text( '' );

  // Fill story view
  // #
  // if( isNextStory )
    this.storyView( story );

  // Animate
  // #
  t1 = setTimeout( function() {
    clearInterval( t1 );

    if( !isNextStory ) {
      this.view.addClass( 'move' )
      this.mask.addClass( 'open' ) 
    }

    this.currentStory = story;
    story.addClass( 'activated' );
	 
  }.bind( this ));

  t2 = setTimeout( function() {
    clearInterval( t2 );

    if( !isNextStory ) {
      this.view.addClass( 'open' ) 
      /**
       *
       *
       * [ jQuery Event: transitionend --> StoryView.view ]
       */
       this.view.one( svTransitionEnd, new this.Helpers.oneTimeFire( function( event ) {
         this.elements.profile.addClass( 'can-visible' );
       }.bind( this )));
    }
  }.bind( this ), 200 );

  $( 'body' ).addClass( 'story-view--shown' );
}

/**
 * @desc
 * @param {} view -
 * @param {} story -
 */
StoryView.prototype.storyView = function( story ) {
  var that = this;
  var bars = $( '<ul class="media-bars" />' )
    , content = this.view.find( '.content' )
    , bar, $media, type, src, sid, stime, sown
    , profileImage, profileName;

  profileImage = story.data().profileImage;
  profileName = story.data().profileName;

  story.find( '.media li *' ).each( function( idx, media ) {
    $media = $( media ); 
    // Create bar
    // #
    bar = $( '<li><span class="progressStory"></span></li>' );
    bar.attr( 'data-type', type = $media.get( 0 ).tagName.toLowerCase() );
    bar.attr( 'data-src', src = $media.attr( 'src' ) );
	bar.attr( 'data-id', sid = $media.parent().data( 'id' ) ); 
	bar.attr( 'data-time', stime = $media.parent().data( 'time' ) ); 
	bar.attr( 'data-sid', sown = $media.parent().data( 'sid' ) ); 
    bars.append( bar ); 
	bars.append( '<div class="" style="position:absolute;width:100%;height:100%;background-image:url( '+src+' ); top:0px;left:0px;bottom:0px;-webkit-filter: blur(15px); -moz-filter: blur(15px); -o-filter: blur(15px); -ms-filter: blur(15px); filter: blur(15px);background-repeat:no-repeat;background-size:cover;-webkit-background-size:cover;-moz-background-size:cover;-o-background-size:cover; background-position:center center;opacity:.4;"></div>' );
    // Save media content
    // #
    that.mediaItems.push({
      duration: $media.parent().data( 'duration' ),
      type: type,
      src: src, 
	  texttt: $media.parent().data('note')
    })   
	var stype = 'wi';
	var dataSTor = 'f='+ stype + '&sids='+ sown;
	 $.ajax({
		   type:'POST',
		  url: requestUrl + 'requests/activity',
		  data: dataSTor,
		  beforeSend: function(){},
		  success: function(response){
				 
		  }
	   });
  });


  // Fill Profile
  // #
  if( profileImage || profileName ) {
    this.elements.profile.removeClass( 'sv-profile-image sv-profile-name' );
    this.elements.profile.find( '.image' ).css( 'background-image', 'url('+ ( profileImage ? profileImage : '' ) +')' );
    this.elements.profile.find( '.name' ).text( profileName ? profileName : '' );

    if( profileImage ) this.elements.profile.addClass( 'sv-profile-image' );
    if( profileName ) this.elements.profile.addClass( 'sv-profile-name' );

    this.elements.profile.addClass( 'show' ); 
  }

  content.find( '.media-bars' ).remove();
  content.prepend( bars );

  // Start from first
  // #
  this.showMedia( this.currentMedia, 'next' );
}

/**
 * @desc
 * @param {} mediaIndex -
 */
StoryView.prototype.showMedia = function( mediaIndex, direction ) {
  var that = this;
  var item = this.mediaItems[ mediaIndex ]
    , content = this.view.find( '.content .media-container' )
    , prevProgressBars = this.view.find( '.media-bars li:lt('+ this.currentMedia +') .progressStory' )
    , nextProgressBars = this.view.find( '.media-bars li:gt('+ this.currentMedia +') .progressStory' )
    , progressBar = this.view
      .find( '.media-bars li' )
      .eq( mediaIndex )
      .find( '.progressStory' ); 
  this.mediaLoading = true;
  this.elements.loading.addClass( 'show' );

  // Cancel previous source loading
  // #
  removeMediaEvents.call( this );


  // Remove media if exist
  // #
  content.empty();
  progressBar.css( 'width', 0 );
  nextProgressBars.css( 'width', '0' );
  prevProgressBars.css( 'width', '100%' );
  this.lastProgressVal = 0;
  this.mediaTempItem = null;
  this.mediaTempLoadFn = null;

  // Create image
  // #
  if( item.type == 'img' ) {
    this.mediaTempItem = new Image();

    /**
     * @desc
     */
    this.mediaTempLoadFn = function() {
      startMedia( that.mediaTempItem, mediaIndex, item.duration, progressBar, direction , item.texttt); 
    };
    var itemText = item.texttt;
	$('.media-text').text(itemText);
    /**
     *
     * [ Image event: load --> StoryView.mediaTemplate ]
     */
    this.mediaTempItem.addEventListener( 'load', this.mediaTempLoadFn );
    this.mediaTempItem.src = item.src;
  }

  // Create Video
  // #
  if( item.type == 'video' ) {
    this.mediaTempItem = document.createElement( 'video' );

    /**
     * @desc
     */
    this.mediaTempLoadFn = function() {
      startMedia( that.mediaTempItem, mediaIndex, item.duration, progressBar, direction,item.texttt );
    };

    /**
     *
     * [ Video event: canplay --> StoryView.mediaTemplate ]
     */
    this.mediaTempItem.addEventListener( 'canplay', this.mediaTempLoadFn );

    this.mediaTempItem.src = item.src;
    this.mediaTempItem.controls = false;
    this.mediaTempItem.setAttribute( 'autoplay', 'autoplay' );
    this.mediaTempItem.setAttribute( 'playsinline', 'playsinline' );
    this.mediaTempItem.setAttribute( 'webkit-playsinline', 'webkit-playsinline' );
  }

  /**
   * @desc
   *
   */
  function removeMediaEvents() {
    if( this.mediaTempItem && this.mediaTempLoadFn ) {
      this.mediaTempItem.removeEventListener(
        this.mediaTempItem.tagName === 'IMG' ? 'load' : 'canplay',
        this.mediaTempLoadFn
      );
    }
  }

  /**
   * @desc
   *
   */
  function startMedia( media, mediaIndex, duration, progressBar, direction ) {
    content.append( media );

    $( that.mediaTempItem ).addClass( 'current-media ' + direction );
    that.mediaLoading = false;
    that.elements.loading.removeClass( 'show' );

    that.mediaStartTime = Date.now();
    that.mediaProgressTick( mediaIndex, duration, progressBar );
    removeMediaEvents.call( that );

    if( that.mediaTempItem.tagName == 'VIDEO' )
      that.mediaTempItem.play();

    setTimeout( function() {
      $( that.mediaTempItem ).addClass( 'effect' );
    }, 250 );
  };
}

/**
 * @desc
 * @param {} mediaIndex -
 * @param {} itemDuration -
 */
StoryView.prototype.mediaProgressTick = function( mediaIndex, itemDuration, progressBar ) {
  var that = this
    , timeDiff = 0
    , tempWidth = 0;


  // Reset progress timer
  // #
  clearInterval( this.currentMediaProgress );

  this.currentMediaProgress = setInterval( function( a ) {
    if( that.mediaLoading ) return;

    // Stop when removing
    // #
    if( that.removingState )
      clearInterval( that.currentMediaProgress );

    if( !that.paused ) {

      // Play when state is in paused
      // #
      if( that.mediaTempItem.tagName == 'VIDEO' )
        that.mediaTempItem.play();

      timeDiff = Date.now() - that.mediaStartTime;
      tempWidth = ( timeDiff / 1000 / itemDuration * 100 );
      tempWidth = ( tempWidth + that.lastProgressVal ) * 1;

      progressBar.css( 'width', tempWidth + '%' )

      // Get next media when finished
      // #
      if( parseInt( tempWidth ) >= 100 ) {
        that.nextMedia();
      }
    }
    //
    // #
    else {
      that.lastProgressVal = tempWidth;
      that.mediaStartTime = Date.now();

      // Pause video when story paused
      // #
      if( that.mediaTempItem.tagName == 'VIDEO' )
        that.mediaTempItem.pause();
    }
  });
}

/**
 * @desc
 * @param {} fromClick -
 */
StoryView.prototype.nextMedia = function( fromClick ) {

  // if user clicked next close story view
  // on last media item of last story
  if( this.currentMedia + 1 == this.mediaItems.length && this.currentStory.next().length == 0 && fromClick ) {
    this.closeView();
    return;
  }

  var next = this.currentMedia + 1 == this.mediaItems.length
    ? this.finish()
    : this.currentMedia++
  ;


  // Show next media
  // #
  if( !!Number( next ) || next === 0 )
    this.showMedia( this.currentMedia, 'next' );
}

/**
 * @desc
 * @param {} fromClick -
 */
StoryView.prototype.prevMedia = function( fromClick ) {

  var prev = this.currentMedia - 1 == -1 && this.currentStory.prev().length > 0
    ? this.finish( true )
    : this.currentMedia - 1 == -1 && this.currentStory.prev().length == 0
      ? this.currentMedia = 0
      : this.currentMedia--
  ;

  // Show next media
  // #
  if( !!Number( prev ) || prev === 0 )
    this.showMedia( this.currentMedia, 'prev' );
}

/**
 * @desc
 * @param {} mediaIndex -
 * @param {} prev -
 */
StoryView.prototype.finish = function( prev ) {
  var story;

  clearInterval( this.currentMediaProgress );

  // Get next story
  // #
  if( !prev && this.currentStory.data().hasNext ) {
    story = this.currentStory.next();
    this.currentMedia = 0;
  }
  // Get prev story
  // #
  else if( prev && this.currentStory.prev().length > 0 ) {
    story = this.currentStory.prev();
    this.currentMedia = story.find( '.media li' ).length - 1;
  }

  if( story ) {
    this.mediaItems = [];
    this.currentStory.removeClass( 'activated' );
    this.openStory( story, true );
  }
  else this.options.autoClose && this.closeView();
}
