var express= require('express');
var bodyParser= require('body-parser');
var request= require('request');
const APP_TOKEN = "EAAEKN4bUKp4BAN6TXNYda7O3XGqTM0GXmLSjj7zTx8zP7zQyOJ3rZBNOb2dzw0nwXWO14p8smp97Jbnulp3dAFV1FSI914VjW0zqdUvPeMn4m81X4dM6utXjZBBulijS1sUQZBOgkyD5BB4Pb3vrxs8O63MQ4nxzOVib0p6dAZDZD";

var app = express();
app.use(bodyParser.json());
app.listen(3000, function(){
    
    console.log("el servidor se encuentra en el puerto 3000");
});

app.get('/', function(req, res){
    res.send('Bienvenido al taller');
});
app.get('/webhook', function(req, res){
    if(req.query['hub.verify_token']=='test_token_say_hello')
    {
        res.send(query['hub.challenge']);
    }else{
        res.send('tu no tienes que entrar aqui');
    };
});