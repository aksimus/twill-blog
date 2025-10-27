@twillBlockTitle('Contact Form')
@twillBlockIcon('mail')
@twillBlockGroup('forms')

<x-block-display-languages />

<x-block-title-description />

<x-twill::input
    name="form_title"
    label="Form Title"
    placeholder="Contact Us"
    :translated="true"
/>

@formField('wysiwyg', [
    'name' => 'form_description',
    'label' => 'Form Description',
    'placeholder' => 'Get in touch with us...',
    'translated' => true,
    'toolbarOptions' => [
        ['header' => [2, 3, 4, 5, 6, false]],
        'bold',
        'italic',
        'underline',
        'strike',
        'blockquote',
        'code-block',
        'ordered',
        'bullet',
        'hr',
        'code',
        'link',
        'clean',
        'table',
        'code-view'
    ]
])

<x-twill::input
    name="email_label"
    label="Email Field Label"
    placeholder="Email Address"
    :translated="true"
/>

<x-twill::input
    name="phone_label"
    label="Phone Field Label"
    placeholder="Phone Number"
    :translated="true"
/>

<x-twill::input
    name="message_label"
    label="Message Field Label"
    placeholder="Message"
    :translated="true"
/>

<x-twill::input
    name="submit_button_text"
    label="Submit Button Text"
    placeholder="Send Message"
    :translated="true"
/>

<x-twill::input
    name="success_message"
    label="Success Message"
    placeholder="Thank you! Your message has been sent successfully."
    :translated="true"
/>

<x-twill::select
    name="form_style"
    label="Form Style"
    :options="[
        ['value' => 'default', 'label' => 'Default Style'],
        ['value' => 'minimal', 'label' => 'Minimal Style'],
        ['value' => 'bordered', 'label' => 'Bordered Style']
    ]"
    default="default"
/>

<x-twill::checkbox
    name="show_phone_field"
    label="Show Phone Field"
    default="true"
    note="Uncheck to hide the phone number field"
/>

<x-twill::checkbox
    name="require_phone"
    label="Require Phone Field"
    default="false"
    note="Make phone number required (only if phone field is shown)"
/>
