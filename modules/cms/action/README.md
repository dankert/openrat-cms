# And... Action!

These action classes are the 'presenter' part in the [model-view-presenter](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93presenter).


Their mission is to
- validate input data
- calling the model
- providing all data for the UI.

### View and Post

Every HTTP-Request contains 2 parameters: 
- `action`: The action class is instantiated with this value. Example: The action "example" will instantiate a class "ExampleAction".
- `method`: The method which should be called in this action (see above)

### View and Post

The parameter `method` and the HTTP method are deciding, which method is called.

Example:
`GET  /?action=example&method=foo` will call _ExampleAction::fooView()_.
`POST /?action=example&method=foo` will call _ExampleAction::fooPost()_.

### Contracts:
- **no database requests are done here!** Database requests are only done by the model classes.