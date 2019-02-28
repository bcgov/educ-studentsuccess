/*
similar to jQuery
 $( document ).ready(function() {
    console.log( "ready!" );});
    or
    $(function(){
      console.log( "ready!" );
    });
*/
document.addEventListener('DOMContentLoaded', init);

function init() {
  let btn = document.getElementById('btn');
  let lnk = document.getElementById('lnk');
  let txt = document.getElementById('txt');

  //type things in input box
  txt.addEventListener('input', ev => {
    //txt is the target
    console.log(ev.type, ev.target, ev.target.value);
  });
  //content changes in input box
  txt.addEventListener('change', ev => {
    console.log(ev.type, ev.target, ev.target.value);
  });
  //cursor leaves the input box
  txt.addEventListener('blur', ev => {
    console.log(ev.type)
  });
  lnk.addEventListener('click', ev => {
    ev.preventDefault();
    console.log(ev.type, ev.target)
  });
  btn.addEventListener('click', buttonClicked);
}


function buttonClicked(ev) {
  console.log(ev.type, ev.target, ev.currentTarget);
}


/*
event bubbling, bubbles up by default
Event Bubbling and Propagation
element.addEventListener( type, func, useCapture); false by default
*/

let m = document.getElementById('m');
let d = document.getElementById('d');
let p = document.getElementById('p');
let s = document.getElementById('s');
let log = console.log;

let highlight = (ev) => {
  //add CSS class "gold" to the clicked element
  //stop the event from bubbling up the chain
  ev.stopPropagation();
  let target = ev.currentTarget;
  target.className = 'gold';
  reset(target);
}

let reset = (_element) => {
  setTimeout(() => {
    _element.className = '';
  }, 2000);
}

d.addEventListener('click', (ev) => {
  //stop the click event from being passed beyond this 
  ev.stopImmediatePropagation();
  log('Hi I\'m a DIV');
});

[m, d, p, s].forEach((element) => {
  element.addEventListener('click', highlight);
});

/*
  event target vs current target

  event target: whcihever we click on, current target: where the Propagation is at
  click on div: event target is div, current target is main
*/
document.querySelector('main').addEventListener('click', clicked);
document.querySelector('div').addEventListener('click', clicked);

function clicked(ev) {
  console.log('The click that was attached to', ev.target.tagName, 'is currently at', ev.currentTarget.tagName);
}


/*
Built-in JS handleEvent method
One function handles all events that are happening to an object 
*/

let obj = {
  init: function () {
    document.querySelector('#btn').addEventListener('click', this);
    document.querySelector('#btn').addEventListener('focus', this);
    document.querySelector('#btn').addEventListener('blur', this);
  },
  //handleEvent is the built-in function
  handleEvent: function (ev) {
    switch (ev.type) {
      case 'click':
        this.something(ev);
        break;
      case 'focus':
        this.something(ev);
        break;
      case 'blur':
        this.something(ev);
        break;
      case 'explode':
        break;
    }
  },
  something: function (ev) {
    //gets called by click event list
    console.log('btn was', ev.type, '-ed.');
  }
}

//get things started
obj.init();


/*
MouseEnter and Mouseleave (more efficient)
VS.
MouseOver and MouseOut 
*/

document.querySelector('.enter p').addEventListener('mouseenter', entering);
document.querySelector('.enter p').addEventListener('mouseleave', leaving);

function entering(ev) {
  ev.currentTarget.style.borderColor = 'gold';
  console.log('mouseenter p');
}

function leaving(ev) {
  ev.currentTarget.style.borderColor = 'black';
  console.log('mouseleave p');
}
document.querySelector('.over p').addEventListener('mouseover', overing);
document.querySelector('.over p').addEventListener('mouseout', outing);

function overing(ev) {
  ev.currentTarget.style.borderColor = 'gold';
  console.log('mouseover p');
}

function outing(ev) {
  ev.currentTarget.style.borderColor = 'black';
  console.log('mouseout p');
}

//NO Differences so far...above


/*
  here when the target is the div and para
  MouseEnter and MouseLeave fire once (one call) at a time 

  MouseOver and MouseOut: cascades and bublling out:
  when move from one html into a child or parent element, it also views that 
  mouse events
*/
document.querySelector('.enter').addEventListener('mouseenter', function (ev) {
  ev.currentTarget.classList.add('blue');
  console.log('mouseenter div. Add blue.');
});
document.querySelector('.enter').addEventListener('mouseleave', function (ev) {
  ev.currentTarget.classList.remove('blue');
  console.log('mouseleave div. Remove blue.');
});

document.querySelector('.over').addEventListener('mouseout', function (ev) {
  ev.currentTarget.classList.remove('blue');
  console.log('mouseout div. Remove blue.');
});
document.querySelector('.over').addEventListener('mouseover', function (ev) {
  ev.currentTarget.classList.add('blue');
  console.log('mouseover div. Add blue.');
  //, ev.currentTarget.tagName, ev.target.tagName
});

/*
  FocusIn and FocusOut (no bubbles)
  vs.
  Focus and Blur (bubbles)

  ev.relatedTarget(): moving btw two focused element, 
  related target it the new focused element
*/
document.querySelector('.in-out input').addEventListener('focusin', goIn);
document.querySelector('.in-out input').addEventListener('focusout', goOut);

function goIn(ev) {
  ev.currentTarget.style.color = 'gold';
  console.log('focusin input left');
  if (ev.relatedTarget) {
    ev.relatedTarget.style.color = 'red';
    console.log('Just left relatedTarget', ev.relatedTarget.id)
  }
}

function goOut(ev) {
  ev.currentTarget.style.color = 'black';
  console.log('focusout input left');
  if (ev.relatedTarget) {
    console.log('Headed to relatedTarget', ev.relatedTarget.id);
  }
}

document.querySelector('.focus-blur input').addEventListener('focus', doFocus);
document.querySelector('.focus-blur input').addEventListener('blur', doBlur);



/*
  Custom events
*/

/*
  1. let evt = new Event('explode'); 
  the 'explode' string is the custom event type
  2. let evt = new CustomEvent('explode', {detail:{speed:20, volume:40}}); this adds a detail object 
      add an object to the detail property
      when event is trigered, use these info
*/

/* 
   1.create an event as variables (object)
   2.add event listener
   3.dispatch the obejct
*/
let born = new Event('born');
let died = new CustomEvent('died', {
  detail: {
    time: Date.now()
  }
});

document.addEventListener('DOMContentLoaded', function () {
  let m = document.querySelector('main');
  addParagraph(m, 'This is a paragraph.');
  addParagraph(m, 'A new Star Wars movie is coming soon.');
  m.addEventListener('click', function (ev) {
    removeParagraph(m, m.firstElementChild);
  })
});

function addParagraph(parent, txt) {
  let p = document.createElement('p');
  p.textContent = txt;
  /*set up and dispatch events
  After an event object is created, 
  we should “run” it on an element using the call elem.dispatchEvent(event)*/

  //nothing happens, if  no one is listening to this event
  p.dispatchEvent(born)
  p.addEventListener('born', wasBorn);
  p.addEventListener('died', hasDied);
  //add to screen
  parent.appendChild(p);
}

// when removing things, also remove the listeners attached to it
// needed for custom event, buil-in is fine
function removeParagraph(parent, p) {
  // dispatch event when remove p 
  p.dispatchEvent(died);
  //remove element from screen
  parent.removeChild(p);
}

function wasBorn(ev) {
  console.log(ev.type, ev.target);
}

function hasDied(ev) {
  console.log(ev.type, ev.target, ev.detail.time);
  //remove the listeners when the element is removed
  ev.target.removeEventListener('born', wasBorn);
  ev.target.removeEventListener('died', hasDied);
}



// TOUCH event: 

//touch events - touchstart, touchend, touchmove, touchcancel
//There is NO tap, doubletap, swipe, swipeleft, swiperight, rotate, pinch, or zoom
//You would have to create those events yourself by connecting to the touch events.
//work on devices that are touch capable
//No error on other devices because 'touchstart' is just a name like winlottery
//The event will probably just never happen on my laptop
document.querySelector('p').addEventListener('touchstart', f);
document.querySelector('p').addEventListener('touchend', f);
//finger movement, client x,y and page x,y are showing
//check the x,y direction determine swipe
document.querySelector('p').addEventListener('touchmove', f);

function f(ev) {
  //touches property: multiple touch objects
  //changedTouches
  //type:event type
  console.log(ev.touches, ev.type);
}


// right click menubar
let menu = null;
document.addEventListener('DOMContentLoaded', function() {
  menu = document.querySelelctor('.menu');
  menu.classList.add('off');

  //add the right click listener to the box
  let box = document.getElementById('box');
  //contextmenu is the RIGHT click
  box.addEventListener('contextmenu', showmenu);

  //add a listener for leaving the menu and hiding it 
  menu.addEventListener('mouseleave', hidemenu);

  //add the listeners for the munu items
  addMenueListeners();
});


function addMenuListeners(){
  document.getElementById('red').addEventListener('click', setColour);
  document.getElementById('gold').addEventListener('click', setColour);
  document.getElementById('green').addEventListener('click', setColour);
}

function setColour(ev){
  hidemenu();
  let clr = ev.target.id;
  document.getElementById('box').style.backgroundColor = clr;
}

function showmenu(ev){
  //stop the real right click menu
  ev.preventDefault(); 
  //show the custom menu
  console.log( ev.clientX, ev.clientY );
  menu.style.top = `${ev.clientY - 20}px`;
  menu.style.left = `${ev.clientX - 20}px`;
  menu.classList.remove('off');
}

function hidemenu(ev){
  menu.classList.add('off');
  menu.style.top = '-200%';
  menu.style.left = '-200%';
}
