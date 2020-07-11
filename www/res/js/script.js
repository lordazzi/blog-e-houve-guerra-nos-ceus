/**
 * Funções de apoio de layout
 */
var MAINMENU_MOBILE_WIDTH_CONDITION = 1000;

function byId(id) {
  return document.getElementById(id);
}

function toogleMainMenu() {
  if (document.body.classList.contains('is-main-menu-active')) {
    document.body.classList.remove('is-main-menu-active');
  } else {
    document.body.classList.add('is-main-menu-active');
  }
}

function updateMainStructureHeight() {
  var mainHeader = byId('main-header');
  var virtualHeader = byId('virtual-height-main-header');
  var mainMenu = byId('main-menu');
  var y = mainHeader.getBoundingClientRect().height;
  var minHeight = innerHeight - y;

  mainMenu.style.height = 'calc(100% - ' + y + 'px)';
  mainMenu.style.minHeight = minHeight + 'px';
  virtualHeader.style.height = y + 'px';

  if (innerWidth < MAINMENU_MOBILE_WIDTH_CONDITION) {
    mainMenu.style.top = y + 'px';
  } else {
    mainMenu.style.top = '';
  }
}

function limitItemScrollabillity(element) {
  if (!element) {
    return;
  }

  var rect = element.getBoundingClientRect();
  var endY = rect.height + rect.top;
  var currentY = scrollY + innerHeight;
  if (currentY > endY) {
    element.style.position = 'relative';
    element.style.top = (currentY - innerHeight - rect.top) + 'px';
  } else {
    element.style.position = '';
    element.style.top = '';
  }
}

try {
  updateMainStructureHeight();
} catch (e) {

}

window.onload = updateMainStructureHeight;
window.onresize = updateMainStructureHeight;
window.onscroll = function () {
  limitItemScrollabillity(byId('main-menu'));
  // limitItemScrollabillity(byId('main'));
};

/**
 * Google Analytics
 */
var SocialNetworkCheck = {

  eventAction: 'SocialNetworkCheck',
  category: 'SocialNetwork',

  facebook: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Facebook'
    });
  },
  twitter: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Twitter'
    });
  },
  youtube: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Youtube'
    });
  },
  reddit: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Reddit'
    });
  },
  github: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Github'
    });
  },
};

var SocialNetworkShare = {

  eventAction: 'SocialNetworkShare',
  category: 'SocialNetwork',

  facebook: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Facebook'
    });
  },
  twitter: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Twitter'
    });
  },
  whatsapp: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Whatsapp'
    });
  },
  copy: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Copy'
    });
  }
};