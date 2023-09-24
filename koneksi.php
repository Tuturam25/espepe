<?php

require_once __DIR__ . '/vendor/autoload.php';

// mongodb://localhost:27017;
// $client = new MongoDB\Client('mongodb+srv://vercel-admin-user:u16AAQs1j0EbAr8C@cluster0.vtlnjr4.mongodb.net/Cluster0?retryWrites=true&w=majority');
$client = new MongoDB\Client('mongodb+srv://vercel-admin-user-651009b70d91c97bac8e5ae4:FCDnImvw1ym2mPgr@cluster0.vtlnjr4.mongodb.net/myFirstDatabase?retryWrites=true&w=majority');
$spp = $client->spp;
