window.Bird = Ember.Application.create();

Bird.Router.map(function() {
    this.resource('login', { path: '/' });
});