const http = require('http');


function handle(req, res) {
    res.writeHead(200, {
        'Content-Type': 'text/html'
    });
    res.write('<h1>');
    res.end('Hello from HTTP module');
}

const server = http.createServer(handle);

server.listen(3000, () => {
    console.log('Server listening at port 3000');
});