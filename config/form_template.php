<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [
    'select' => '<label for="{{id}}">{{text}}</label> <select id="{{id}}" name="{{name}}" {{attrs}}>{{content}}</select>',
    'option' => '<option value="{{value}}" {{attrs}}>{{text}}</option>',
    'optgroup' => '<optgroup label="{{label}}" {{attrs}}>{{content}}</optgroup>',
    'selectMultiple' => '<select name="{{name}}[]" multiple="multiple" {{attrs}}>{{content}}</select>'
];

?>