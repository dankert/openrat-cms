# And... Action!

These action classes are the 'presenter' part in the [model-view-presenter](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93presenter).


Their mission is to
- validate input data
- calling the model
- providing all data for the UI.

Contracts:
- **no database requests are done here!** Database requests are only done by the model classes.