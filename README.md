#Happy Sad Tech Test

##Context
The way I tackled this tech test was by breaking the task into different problems. After this break down I started to plan my tests. I tested each component and then combined the components all together in the end. I started by creating a text sentiment generator class which has default happy and sad words in an array. This was to judge whether or not a string contains any happy or sad words. I split a user's string into seperate words and put them in an array. Then I decided to iterate through each word and see if that word is happy or sad. If the word was the same as a happy or sad word then the happy or sad word count increased. Then I compared the counts once the loop had finished. If the happy count was 50% more than the sad count then my method would return the string 'Happy :)'. If the sad count was 50% more than the happy count then my method would return the sting 'Sad :('. Otherwise my method would return the string 'Unknown :S'. 

##Technology Used
- PHP
- Composer
- PHPUnit

##Usage Instructions 

```sh
$ cd tsu
$ composer install
$ vendor/bin/phpunit
```