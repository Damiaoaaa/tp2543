const express=require('express');
const cors=require('cors');
const bodyParser=require('body-parser');
const package=require('./package.json');

const port=process.env.port || process.env.PORT || 5000;
const apiRoot = '/api'

const app=express();

app.use(bodyParser.urlencoded({ extended: true}));
app.use(bodyParser.json());
app.use(cors({origin: /http:\/\/localhost/}));
app.options('*',cors());


const db={
	'christopher':{
		'users':'christopher',
		'currency':'USD',
		'balance':100,
		'description':'A sample account',
		'transactions':[]
	}
}


const router=express.Router();
router.get('/',(req,res)=>{
	res.send(`${package.description} - v${package.version}`);
});

router.get('/accounts/:user',(req,res)=>{
	const user=req.params.user;
	const account=db[user];

	if(!account){
		return res 
				.status(404)
				.json({error: 'User does not exist'});
	}
	return res.json(account);
});

router.post('/accounts',(req,res)=>{
	const body=req.body;


	if(!body.user||!body.currency){
		return res 
				.status(404)
				.json({error: 'User and currency are required'});
	}


if(db[body.user]){
		return res 
				.status(404)
				.json({error: 'Account already exists'});
	}


	let balance=bodoy.balance;
	if(balance&&typeof(balance)!=='number'){
		balance=parseFloat(balance);
		if(isNaN(balance)){
			return res 
				.status(404)
				.json({error: 'balance must be a number'});
		}
	}
	

	const account={
		user: body.user,
		currency: body.currency,
		description: body.description || `${body.user}'saccount'`,
		balance: balance || 0,
		transactions: []
	};
	
	db[account.user] = account;
	
	return res
		.status(201)
		.json(account);
	
})