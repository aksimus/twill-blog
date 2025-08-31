@php
    // Extract block data using proper Twill methods
    $title = $block->translatedInput('title') ?? 'Contact Us';
    $description = $block->translatedInput('description') ?? '';
    $emailLabel = $block->translatedInput('email_label') ?? 'Email Address';
    $phoneLabel = $block->translatedInput('phone_label') ?? 'Phone Number';
    $messageLabel = $block->translatedInput('message_label') ?? 'Message';
    $submitButtonText = $block->translatedInput('submit_button_text') ?? 'Send Message';
    $successMessage = $block->translatedInput('success_message') ?? 'Thank you! Your message has been sent successfully.';
    $formStyle = $block->input('form_style') ?? 'default';
    $showPhoneField = $block->input('show_phone_field') ?? true;
    $requirePhone = $block->input('require_phone') ?? false;
    
    // Generate unique ID for this form instance
    $formId = 'contact-form-' . uniqid();
    
    // Define CSS classes based on form style
    $containerClasses = match($formStyle) {
        'minimal' => 'bg-transparent border-none shadow-none',
        'bordered' => 'bg-white border-2 border-gray-200 shadow-sm',
        default => 'bg-white border border-gray-200 shadow-lg'
    };
    
    $inputClasses = match($formStyle) {
        'minimal' => 'border-b-2 border-gray-300 bg-transparent rounded-none focus:border-blue-500 focus:bg-transparent',
        'bordered' => 'border-2 border-gray-300 bg-gray-50 focus:border-blue-500 focus:bg-white',
        default => 'border border-gray-300 bg-white focus:border-blue-500'
    };
@endphp

<div class="contact-form-block my-8 max-w-2xl mx-auto" id="{{ $formId }}">
    <div class="p-6 rounded-lg {{ $containerClasses }}">
        
        @if($title)
            <h3 class="text-2xl font-bold text-gray-900 mb-4 text-center">{{ $title }}</h3>
        @endif
        
        @if($description)
            <div class="prose text-gray-600 mb-6 text-center">
                {!! $description !!}
            </div>
        @endif
        
        <!-- Success Message (hidden by default) -->
        <div id="{{ $formId }}-success" class="hidden bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span>{{ $successMessage }}</span>
            </div>
        </div>
        
        <!-- Error Message (hidden by default) -->
        <div id="{{ $formId }}-error" class="hidden bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6">
            <div class="flex items-center">
                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"></path>
                </svg>
                <span id="{{ $formId }}-error-message">There was an error sending your message. Please try again.</span>
            </div>
        </div>
        
        <form id="{{ $formId }}-form" action="{{ route('contact.submit') }}" method="POST" class="space-y-6">
            @csrf
            
            <!-- Email Field (Required) -->
            <div>
                <label for="{{ $formId }}-email" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $emailLabel }} <span class="text-red-500">*</span>
                </label>
                <input 
                    type="email" 
                    id="{{ $formId }}-email" 
                    name="email" 
                    required 
                    class="w-full px-4 py-3 rounded-md {{ $inputClasses }} focus:ring-2 focus:ring-blue-500 focus:outline-none transition-colors"
                    placeholder="your@email.com"
                >
                <div class="text-red-500 text-sm mt-1 hidden" id="{{ $formId }}-email-error"></div>
            </div>
            
            <!-- Phone Field (Optional/Conditional) -->
            @if($showPhoneField)
            <div>
                <label for="{{ $formId }}-phone" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $phoneLabel }} @if($requirePhone)<span class="text-red-500">*</span>@endif
                </label>
                <input 
                    type="tel" 
                    id="{{ $formId }}-phone" 
                    name="phone" 
                    @if($requirePhone) required @endif
                    class="w-full px-4 py-3 rounded-md {{ $inputClasses }} focus:ring-2 focus:ring-blue-500 focus:outline-none transition-colors"
                    placeholder="+1 (555) 123-4567"
                >
                <div class="text-red-500 text-sm mt-1 hidden" id="{{ $formId }}-phone-error"></div>
            </div>
            @endif
            
            <!-- Message Field -->
            <div>
                <label for="{{ $formId }}-message" class="block text-sm font-medium text-gray-700 mb-2">
                    {{ $messageLabel }} <span class="text-red-500">*</span>
                </label>
                <textarea 
                    id="{{ $formId }}-message" 
                    name="message" 
                    required 
                    rows="5"
                    class="w-full px-4 py-3 rounded-md {{ $inputClasses }} focus:ring-2 focus:ring-blue-500 focus:outline-none transition-colors resize-vertical"
                    placeholder="Tell us how we can help you..."
                ></textarea>
                <div class="text-red-500 text-sm mt-1 hidden" id="{{ $formId }}-message-error"></div>
            </div>
            
            <!-- Submit Button -->
            <div class="text-center">
                <button 
                    type="submit" 
                    id="{{ $formId }}-submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 px-8 rounded-md transition-colors duration-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                >
                    <span id="{{ $formId }}-submit-text">{{ $submitButtonText }}</span>
                    <svg id="{{ $formId }}-loading" class="hidden animate-spin ml-2 h-4 w-4 text-white inline" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                    </svg>
                </button>
            </div>
            
        </form>
    </div>
</div>

<!-- JavaScript for form handling -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('{{ $formId }}-form');
    const submitBtn = document.getElementById('{{ $formId }}-submit');
    const submitText = document.getElementById('{{ $formId }}-submit-text');
    const loading = document.getElementById('{{ $formId }}-loading');
    const successDiv = document.getElementById('{{ $formId }}-success');
    const errorDiv = document.getElementById('{{ $formId }}-error');
    const errorMessage = document.getElementById('{{ $formId }}-error-message');
    
    // Clear any previous error messages
    function clearErrors() {
        document.querySelectorAll(`[id^="{{ $formId }}-"][id$="-error"]`).forEach(el => {
            el.textContent = '';
            el.classList.add('hidden');
        });
        errorDiv.classList.add('hidden');
        successDiv.classList.add('hidden');
    }
    
    // Show field error
    function showFieldError(field, message) {
        const errorEl = document.getElementById(`{{ $formId }}-${field}-error`);
        if (errorEl) {
            errorEl.textContent = message;
            errorEl.classList.remove('hidden');
        }
    }
    
    // Show general error
    function showError(message) {
        errorMessage.textContent = message;
        errorDiv.classList.remove('hidden');
    }
    
    // Show success
    function showSuccess() {
        successDiv.classList.remove('hidden');
        form.reset(); // Clear form after successful submission
    }
    
    form.addEventListener('submit', async function(e) {
        e.preventDefault();
        clearErrors();
        
        // Show loading state
        submitBtn.disabled = true;
        submitText.classList.add('hidden');
        loading.classList.remove('hidden');
        
        try {
            const formData = new FormData(form);
            
            // AJAX request to /api-front/contact-form
            const response = await fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || formData.get('_token')
                },
                credentials: 'same-origin'
            });
            
            // Parse JSON response
            const result = await response.json();
            
            if (response.ok && result.success) {
                console.log('Contact form submitted successfully:', result.data);
                showSuccess();
            } else {
                // Handle validation errors (422)
                if (response.status === 422 && result.errors) {
                    Object.keys(result.errors).forEach(field => {
                        showFieldError(field, result.errors[field][0]);
                    });
                } else {
                    showError(result.message || 'There was an error sending your message. Please try again.');
                }
            }
        } catch (error) {
            console.error('Contact form AJAX error:', error);
            showError('Network error: Unable to send your message. Please check your connection and try again.');
        } finally {
            // Hide loading state
            submitBtn.disabled = false;
            submitText.classList.remove('hidden');
            loading.classList.add('hidden');
        }
    });
});
</script>
