<?php

use Georgehadjisavva\ElevenApiClient\ElevenApiClient;
use Georgehadjisavva\ElevenApiClient\Interfaces\ElevenClientInterface;
use Georgehadjisavva\ElevenApiClient\Responses\ErrorResponse;

beforeEach(function () {
    $this->apiKey = ''; // add your token
    $this->client = new ElevenApiClient($this->apiKey);
});


test('Correct Instance of ElevenApiClientInterface', function () {
    $this->assertInstanceOf(ElevenClientInterface::class, $this->client);
});


test('Check get voices endpoint' , function(){
    $results = $this->client->getVoices(); 
    expect($results)->toBeArray();
    // var_dump($results);
    // ob_flush();
});



/* test('[SUCESS WITH 200] Create new voice based on content' , function(){
    $content = 'test from laravel';

    $results = $this->client->generateVoice($content); 
    
    $this->assertInstanceOf(SuccessResponse::class,$results);
}); */

test('[FAILED WITH 401] Create new voice based on content' , function(){
    $content  = 'test from laravel';
    $response = $this->client->generateVoice($content); 

    $this->assertInstanceOf(ErrorResponse::class,$response);
    $this->assertStringContainsString('Provided API key seems to be invalid , please check your Account api key and try again !',$response->getMessage());
});

