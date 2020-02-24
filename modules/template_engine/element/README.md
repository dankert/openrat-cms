# Element and Attributes

The template compiler is transforming the component tree into a tree of elements. 

## Example

    form
    + link
      + text

is transformed into

    form
    + div
      + a
        + span
    + div
      + button
      + button

# Values and ValueExpressions

[Value](Value.class.php)s are a string, which may contain [ValueExpression](ValueExpression.class.php) objects.

## Example

    i am ${feeling}

The value is `i am ${feeling}` and it contains a ValueExpression object based on `${feeling}`.
