<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

return [


    // Used for button elements in button().
    'button' => '<button class="btn {{extra_class}}" {{attrs}}>{{text}}</button>',
    // Used for checkboxes in checkbox() and multiCheckbox().
    //'checkbox' => '<input type="checkbox" class="custom-control-input {{extra_class}}" name="{{name}}" value="{{value}}" {{attrs}}>',
    'checkbox' => '<div class="{{ctnClass}}">
                    <div class="form-group">
                    <label class="custom-control {{lblClass}}">
                        <input type="checkbox" class="custom-control-input {{extra_class}}" name="{{name}}" value="{{value}}" {{attrs}}>
                        <span class="custom-control-label">{{text}}</span>
                    </label>
                    </div>
                    </div>',

    // Input group wrapper for checkboxes created via control().
    //--Ver2-- 'checkboxFormGroup' => '{{label}}FGFG',
    'checkboxFormGroup' => '{{label}}FGFG',
    // Wrapper container for checkboxes.
    'checkboxWrapper' => '<div class="checkbox">{{label}}WWWWW</div>',
    // Error message wrapper elements.
    'error' => '<label class="error">{{content}}</label>',
    // Container for error items.
    'errorList' => '<ul>{{content}}</ul>',
    // Error item wrapper.
    'errorItem' => '<li>{{text}}</li>',
    // File input used by file().
    'file' => '<input type="file" name="{{name}}" class="form-control {{extra_class}}" {{attrs}}>',
    // Fieldset element used by allControls().
    'fieldset' => '<fieldset{{attrs}}>{{content}}</fieldset>',
    // Open tag used by create().
    'formStart' => '<form{{attrs}}>',
    // Close tag used by end().
    'formEnd' => '</form>',
    // General grouping container for control(). Defines input/label ordering.
    'formGroup' => '{{label}}{{input}}',
    // Wrapper content used to hide other content.
    'hiddenBlock' => '<div style="display:none;">{{content}}</div>',
    // Generic input element.
    'input' => '<input type="{{type}}" name="{{name}}" class="form-control {{extra_class}}" {{attrs}}/>',
    // Submit input element.
    'inputSubmit' => '<input type="{{type}}" {{attrs}}/>',
    // Container element used by control().
    'inputContainer' => '<div class="{{ctnClass}}" {{ctnAttribute}}><div class="form-group">{{content}}</div></div>',
    // Container element used by control() when a field has an error.
    'inputContainerError' => '<div class="input form-group {{ctnClass}} {{type}}{{required}} error">{{content}}{{error}}</div>',
    // Label element when inputs are not nested inside the label.
    'label' => '<label class="form-label {{lblClass}}" {{attrs}}>{{text}}</label>',
    // Label element used for radio and multi-checkbox inputs.
    'nestingLabel' => '{{hidden}}{{input}}<span class="custom-control-label" {{attrs}}>{{text}}</span>',
    // Legends created by allControls()
    'legend' => '<legend>{{text}}</legend>',
    // Multi-Checkbox input set title element.
    'multicheckboxTitle' => '<legend>{{text}}</legend>',
    // Multi-Checkbox wrapping container.
    'multicheckboxWrapper' => '<fieldset{{attrs}}>{{content}}</fieldset>',
    // Option element used in select pickers.
    'option' => '<option value="{{value}}"{{attrs}}>{{text}}</option>',
    // Option group element used in select pickers.
    'optgroup' => '<optgroup label="{{label}}"{{attrs}}>{{content}}</optgroup>',
    // Select element,
    'select' => '<select name="{{name}}" class="form-control {{extra_class}}" {{attrs}}>{{content}}</select>',
    //'select' => '<select name="{{name}}" {{attrs}}>{{content}}</select>',
    // Multi-select element,
    'selectMultiple' => '<select name="{{name}}[]" multiple="multiple" class="form-control {{extra_class}}" {{attrs}}>{{content}}</select>',
    // Radio input element,
    'radio' => '<input type="radio" name="{{name}}" value="{{value}}" {{attrs}}>',
    // Wrapping container for radio input/label,
    'radioWrapper' => '<label class="{{ctnClass}}"> {{label}} </label>',
    // Textarea input element,
    'textarea' => '<textarea name="{{name}}" class="form-control {{extra_class}}" {{attrs}}>{{value}}</textarea>',
    // Container for submit buttons.
    'submitContainer' => '<div class="{{ctnClass}} align-center">{{content}}</div>',
    // Confirm javascript template for postLink()
    'confirmJs' => '{{confirm}}',
    // selected class
    'selectedClass' => 'selected',
];

?>