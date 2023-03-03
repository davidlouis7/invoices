listenClick('.user-delete-btn', function (event) {
    let recordId = $(event.currentTarget).data('id');
    deleteItem(route('users.destroy', recordId), 'user',
        Lang.get('messages.admin'));
})
