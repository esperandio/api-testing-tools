const frisby = require('frisby');

it('test get success', function () {
    return frisby
        .get('http://json_server:3000/posts/1')
        .expect('status', 200)
        .expect('json', 'id', 1)
        .expect('json', 'title', 'json-server')
        .expect('json', 'author', 'typicode')
});

it('test get failed', function () {
    return frisby
        .get('http://json_server:3000/posts/10000')
        .expect('status', 404)
        .expect('json', {})
});

it('test post success', function () {
    return frisby
        .post('http://json_server:3000/posts', {
            title: 'json-server 2',
            author: 'typicode'
        })
        .expect('status', 201)
        .expect('bodyContains', 'json-server 2')
});