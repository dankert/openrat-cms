# OQuery

OQuery is a lightweight ES6-ready replacement for JQuery.

# Example

```
import $ from './OQuery.js';

// Selectors
$('.myclass').removeClass('otherclass');

// Events
$('.myclass').children('.subclass').click( function() {
    $(this).closest('.otherclass').toggleClass('--is-open');
});
```

Modern browsers are accepting this ECMA-Script-6 syntax directly, so there is no need to use webpack.

# Creating elements

```
$.create('div').addClass('myclass').appendTo( $('body') );
```

# Drawbacks

OQuery is **not** fully feature-compatible to JQuery!

- No AJAX functions (today we are using the native `fetch`)
- No effects
- The constructor is only accepting selectors