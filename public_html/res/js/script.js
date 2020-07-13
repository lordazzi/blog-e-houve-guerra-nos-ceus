/**
 * Funções de apoio de layout
 */
var MAINMENU_MOBILE_WIDTH_CONDITION = 1000;

function byId(id) {
  return document.getElementById(id);
}

function fixDecimal(n) {
  return Number(n.toFixed(2));
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

  mainMenu.style.height = 'calc(100% - ' + fixDecimal(y) + 'px)';
  mainMenu.style.minHeight = fixDecimal(minHeight) + 'px';
  virtualHeader.style.height = fixDecimal(y) + 'px';

  if (innerWidth < MAINMENU_MOBILE_WIDTH_CONDITION) {
    mainMenu.style.top = fixDecimal(y) + 'px';
  } else {
    mainMenu.style.top = '';
  }
}

function limitMainMenuScrollabillity() {
  var mainMenu = byId('main-menu');
  var mainHeader = byId('main-header');
  var mainFooter = byId('main-footer');

  var mainMenuRec = mainMenu.getBoundingClientRect();
  var mainHeaderRec = mainHeader.getBoundingClientRect();
  var mainFooterRec = mainFooter.getBoundingClientRect();

  var endY = mainMenuRec.height + mainHeaderRec.height;
  var currentY = scrollY + innerHeight;
  var topPx;

  if (innerWidth < MAINMENU_MOBILE_WIDTH_CONDITION) {
    mainMenu.style.top = '';
    mainMenu.style.position = '';
  } else if (currentY > (mainFooterRec.top + scrollY)) {
    topPx = fixDecimal((mainFooterRec.top + scrollY) - mainMenuRec.height - mainHeaderRec.height) + 'px';
    mainMenu.style.position = 'relative';
    mainMenu.style.top = topPx;
  } else if (currentY > endY) {
    topPx = fixDecimal(currentY - endY) + 'px';
    mainMenu.style.position = 'relative';
    mainMenu.style.top = topPx;
  } else {
    mainMenu.style.position = '';
    mainMenu.style.top = '';
  }
}

function getTimestamp(h, i, d, m, y) {
  var date = new Date();
  h = h == null ? date.getUTCHours() : h;
  i = i == null ? date.getUTCMinutes() : i;
  d = d == null ? date.getUTCDate() : d;
  m = m == null ? date.getUTCMonth() : m;
  y = y == null ? date.getUTCFullYear() : y;

  date.setUTCSeconds(0);
  date.setUTCHours(h);
  date.setUTCMinutes(i);
  date.setUTCDate(d);
  date.setUTCMonth(m);
  date.setUTCFullYear(y);

  return Math.floor(date.getTime() / 1000) + (3 * 60 * 60);
}

try {
  updateMainStructureHeight();
} catch (e) {

}

window.onload = updateMainStructureHeight;
window.onscroll = limitMainMenuScrollabillity;
window.onresize = function () {
  updateMainStructureHeight();
  limitMainMenuScrollabillity();
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
      'event_label': 'Facebook',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkCheck.category + ': Facebook');
      }
    });
  },
  twitter: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Twitter',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkCheck.category + ': Twitter');
      }
    });
  },
  youtube: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Youtube',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkCheck.category + ': Youtube');
      }
    });
  },
  reddit: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Reddit',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkCheck.category + ': Reddit');
      }
    });
  },
  github: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Github',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkCheck.category + ': Github');
      }
    });
  },
};

var SocialNetworkShare = {

  eventAction: 'SocialNetworkShare',
  category: 'SocialNetwork',

  facebook: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Facebook',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkShare.category + ': Facebook');
      }
    });
  },
  twitter: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Twitter',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkShare.category + ': Twitter');
      }
    });
  },
  whatsapp: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Whatsapp',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkShare.category + ': Whatsapp');
      }
    });
  },
  copy: function () {
    gtag('event', this.eventAction, {
      'event_category': this.category,
      'event_label': 'Copy',
      'event_callback': function () {
        console.log('Gttag callback ' + SocialNetworkShare.category + ': Copy');
      }
    });
  }
};