@extends('layouts.index')

@section('content')
<div 
    x-data="applicationForm()"
    x-init="init()"
    class="space-y-8 max-w-5xl mx-auto my-10"
>

    <!-- Header / Title Section -->
    <div class="text-center space-y-2">
        <h1 class="text-3xl font-bold text-primary">
            International University Theater Festival of Casablanca
        </h1>
        <p class="text-xl text-muted-foreground">
            37th Edition • July 10-15, 2025
        </p>
        <p class="text-lg font-medium text-primary">
            Theme: Theater and Artistic-Cultural Diplomacy
        </p>
    </div>

    <!-- Enhanced Step Indicator -->
    <div class="py-4 px-6 bg-white rounded-lg shadow-md">
        <div class="relative">
            <!-- Progress Bar Background -->
            <div class="absolute top-1/2 left-0 h-1 w-full bg-gray-200 -translate-y-1/2"></div>
            
            <!-- Actual Progress Bar -->
            <div class="absolute top-1/2 left-0 h-1 bg-blue-600 -translate-y-1/2 transition-all duration-500 ease-in-out"
                :style="`width: ${(currentStep - 1) * 16.66}%`"></div>
            
            <!-- Steps Indicators -->
            <div class="relative flex justify-between">
                <template x-for="(step, index) in steps" :key="index">
                    <div class="flex flex-col items-center">
                        <!-- Step Circle -->
                        <button 
                            @click="goToStep(index + 1)" 
                            :class="{ 
                                'bg-blue-600 text-white border-blue-600': currentStep >= index + 1,
                                'bg-white text-gray-500 border-gray-300': currentStep < index + 1,
                                'animate__animated animate__pulse': currentStep === index + 1
                            }"
                            class="w-10 h-10 rounded-full flex items-center justify-center font-medium border-2 transition-all duration-300 hover:scale-110 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 relative z-10"
                        >
                            <span x-show="completedSteps[index]" class="absolute -top-1 -right-1 bg-green-500 rounded-full w-4 h-4 flex items-center justify-center animate__animated animate__bounceIn">
                                <svg class="w-3 h-3 text-white" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd"></path>
                                </svg>
                            </span>
                            <span x-text="index + 1"></span>
                        </button>
                        
                        <!-- Step Title -->
                        <span 
                            class="mt-2 text-xs font-medium transition-colors duration-300 text-center" 
                            :class="{ 'text-blue-600': currentStep >= index + 1, 'text-gray-500': currentStep < index + 1 }"
                            x-text="step.title"
                        ></span>
                    </div>
                </template>
            </div>
        </div>
    </div>

    <!-- Saved State Banner (shows when returning to a form with saved data) -->
    <div x-show="formHasSavedState" x-transition:enter="transition ease-out duration-300" 
         x-transition:enter-start="opacity-0 transform -translate-y-4" 
         x-transition:enter-end="opacity-100 transform translate-y-0"
         class="bg-green-50 border-l-4 border-green-500 p-4 rounded animate__animated animate__fadeIn">
        <div class="flex items-center">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
            </div>
            <div class="ml-3">
                <p class="text-sm text-green-700">
                    Your progress has been loaded. You can continue where you left off.
                    <button @click="clearSavedState" class="ml-2 text-green-800 underline hover:text-green-900">Start fresh</button>
                </p>
            </div>
        </div>
    </div>

    <!-- Card -->
    <div x-ref="formCard" class="border border-primary/20 rounded-lg shadow-lg transition-all duration-500 ease-in-out bg-white hover:shadow-xl">

        <!-- Card Header -->
        <div class="bg-primary/5 border-b border-primary/10 px-6 py-4">
            <!-- Dynamically show step title and description -->
            <div class="flex items-center">
                <div class="flex-1">
                    <h2 class="text-xl font-semibold animate__animated animate__fadeIn" x-text="steps[currentStep-1].title"></h2>
                    <p class="text-sm text-gray-600 mt-1 animate__animated animate__fadeIn" x-text="steps[currentStep-1].description"></p>
                </div>
                <div class="text-right">
                    <span class="text-sm text-gray-500">Step <span x-text="currentStep"></span> of <span x-text="steps.length"></span></span>
                </div>
            </div>
        </div>

        <!-- Card Content -->
        <div class="p-6">
            <form id="applicationForm" method="POST" action="{{ route('application.store') }}" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <input type="hidden" name="debug_mode" value="1">

                <!-- Step Content (dynamically loaded) -->
                <div x-show="currentStep === 1" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="animate__animated animate__fadeIn">
                    @include('application.partials.step1')
                </div>

                <div x-show="currentStep === 2" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="animate__animated animate__fadeIn">
                    @include('application.partials.step2')
                </div>

                <div x-show="currentStep === 3" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="animate__animated animate__fadeIn">
                    @include('application.partials.step3')
                </div>

                <div x-show="currentStep === 4" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="animate__animated animate__fadeIn">
                    @include('application.partials.step4')
                </div>

                <div x-show="currentStep === 5" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="animate__animated animate__fadeIn">
                    @include('application.partials.step5')
                </div>

                <div x-show="currentStep === 6" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="animate__animated animate__fadeIn">
                    @include('application.partials.step6')
                </div>

                <div x-show="currentStep === 7" x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0 transform translate-y-4" x-transition:enter-end="opacity-100 transform translate-y-0" class="animate__animated animate__fadeIn">
                    @include('application.partials.step7')
                </div>

                <!-- Card Footer (Navigation Buttons) -->
                <div class="flex justify-between border-t border-primary/10 pt-4 mt-6">
                    <!-- Previous Button -->
                    <button
                        type="button"
                        x-show="currentStep > 1"
                        @click="previousStep"
                        class="flex items-center gap-1 px-4 py-2 bg-gray-200 text-gray-700 rounded hover:bg-gray-300 transition-colors duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-opacity-50"
                    >
                        <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 19l-7-7 7-7"></path>
                        </svg>
                        Previous
                    </button>
                    <div x-show="currentStep === 1"></div>

                    <div class="flex space-x-2">
                        <!-- Save Draft -->
                        <button
                            type="button"
                            @click="saveDraft"
                            class="px-4 py-2 border border-blue-600 text-blue-600 rounded hover:bg-blue-50 transition-colors duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                        >
                            <span class="flex items-center gap-1">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                                </svg>
                                Save Draft
                            </span>
                        </button>

                        <!-- Next / Submit -->
                        <button
                            type="button"
                            x-show="currentStep < 7"
                            @click="nextStep"
                            class="flex items-center gap-1 px-6 py-2 bg-blue-600 text-white rounded hover:bg-blue-700 transition-colors duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-blue-400 focus:ring-opacity-50"
                        >
                            Next
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9 5l7 7-7 7"></path>
                            </svg>
                        </button>

                        <!-- Final Submit -->
                        <button
                            type="submit"
                            x-show="currentStep === 7"
                            :disabled="isSubmitting"
                            class="flex items-center gap-1 px-6 py-2 bg-green-600 text-white rounded hover:bg-green-700 transition-colors duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-green-400 focus:ring-opacity-50"
                        >
                            <span x-show="!isSubmitting">Submit Application</span>
                            <span x-show="isSubmitting" class="inline-flex items-center">
                                <svg class="animate-spin -ml-1 mr-2 h-4 w-4 text-white" fill="none" viewBox="0 0 24 24">
                                    <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                                    <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                                </svg>
                                Processing...
                            </span>
                        </button>
                        
                        <!-- Direct submit button for debugging -->
                        <button 
                            type="submit"
                            x-show="currentStep === 7" 
                            class="px-4 py-2 bg-purple-600 text-white rounded hover:bg-purple-700 transition-colors duration-300 transform hover:scale-105 focus:outline-none focus:ring-2 focus:ring-purple-400 focus:ring-opacity-50"
                        >
                            Direct Submit (Debug)
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Enhanced Alpine.js logic --}}
<script>
    document.addEventListener('alpine:init', () => {
        Alpine.data('applicationForm', () => ({
            currentStep: 1,
            totalSteps: 7,
            isSubmitting: false,
            completedSteps: [false, false, false, false, false, false, false],
            notificationMessage: '',
            notificationType: 'info',
            showNotificationBanner: false,
            formHasSavedState: false,
            userId: "{{ Auth::id() ?? 'guest' }}", // Add user ID to make localStorage keys user-specific
            
            // Form validation rules
            validationRules: {
                email: /^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/,
                phone: /^[+]?[0-9]{10,15}$/,
            },
            
            // Validation method for specific field types
            validateField(field, type) {
                const input = document.querySelector(`[name="${field}"]`);
                if (!input) return true;
                
                if (!input.value && input.hasAttribute('required')) {
                    return false;
                }
                
                if (input.value && type && this.validationRules[type]) {
                    return this.validationRules[type].test(input.value);
                }
                
                return true;
            },
            
            // Check if current step is valid
            isStepValid(stepIndex) {
                const stepFields = this.steps[stepIndex].fields;
                let isValid = true;
                
                for (const field of stepFields) {
                    // Special validation for email and phone fields
                    if (field === 'contact_email') {
                        if (!this.validateField(field, 'email')) {
                            isValid = false;
                            const input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('border-red-500');
                                this.showFieldError(input, 'Please enter a valid email address');
                            }
                        }
                    } else if (field === 'contact_phone') {
                        if (!this.validateField(field, 'phone')) {
                            isValid = false;
                            const input = document.querySelector(`[name="${field}"]`);
                            if (input) {
                                input.classList.add('border-red-500');
                                this.showFieldError(input, 'Please enter a valid phone number (10-15 digits)');
                            }
                        }
                    } else {
                        const input = document.querySelector(`[name="${field}"]`);
                        if (input && input.hasAttribute('required') && !input.value) {
                            isValid = false;
                            input.classList.add('border-red-500');
                            this.showFieldError(input, 'This field is required');
                        }
                    }
                }
                
                return isValid;
            },
            
            // Show error message for a field
            showFieldError(input, message) {
                // Remove any existing error message
                const existingError = input.parentNode.querySelector('.validation-error');
                if (existingError) {
                    existingError.remove();
                }
                
                // Create and append error message
                const errorDiv = document.createElement('div');
                errorDiv.className = 'validation-error text-red-600 text-sm mt-1';
                errorDiv.textContent = message;
                input.parentNode.appendChild(errorDiv);
                
                // Add event listener to clear error on input
                input.addEventListener('input', () => {
                    input.classList.remove('border-red-500');
                    const error = input.parentNode.querySelector('.validation-error');
                    if (error) {
                        error.remove();
                    }
                }, { once: true });
            },
            
            steps: [
                {
                    title: "Basic Information",
                    description: "General information about your troupe and play",
                    fields: ['country', 'university', 'troupe_name', 'play_title', 'author', 'director', 'duration', 'summary']
                },
                {
                    title: "Play Details",
                    description: "Specific details about your play",
                    fields: ['language', 'premiere_date', 'original_summary', 'english_summary', 'french_summary', 'arabic_summary', 'play_link']
                },
                {
                    title: "Company Info",
                    description: "Information about your theater company",
                    fields: ['founded_year', 'company_background', 'repertoireStyle', 'alreadyPlayed', 'actors_count']
                },
                {
                    title: "Contact Information",
                    description: "Contact details for communication",
                    fields: ['contact_name', 'contact_email', 'contact_phone', 'contact_position']
                },
                {
                    title: "Technical Details",
                    description: "Technical requirements for your performance",
                    fields: ['staging_type', 'special_requirements', 'technical_notes']
                },
                {
                    title: "Cast & History",
                    description: "Cast members and participation history",
                    fields: ['cast_names', 'cast_roles', 'previous_festival', 'previous_year', 'previous_play']
                },
                {
                    title: "Performances & Attachments",
                    description: "Previous and upcoming performances, attachments",
                    fields: ['previousPerformances', 'upcomingPerformances', 'attachments', 'attachment_types']
                }
            ],
            
            // Initialize
            init() {
                // Load saved form data on init
                this.loadFormData();
                
                // Add event listeners for form fields to auto-save
                const form = document.getElementById('applicationForm');
                if (form) {
                    form.addEventListener('change', () => {
                        this.saveFormData();
                    });
                    
                    // Add input event listeners for validation feedback
                    const inputs = form.querySelectorAll('input, textarea, select');
                    inputs.forEach(input => {
                        input.addEventListener('input', () => {
                            input.classList.remove('border-red-500');
                            const error = input.parentNode.querySelector('.validation-error');
                            if (error) {
                                error.remove();
                            }
                        });
                    });
                }
            },
            
            // Save form data to localStorage
            saveFormData() {
                const formData = new FormData(document.getElementById('applicationForm'));
                const formObject = {};
                
                for (const [key, value] of formData.entries()) {
                    formObject[key] = value;
                }
                
                localStorage.setItem(this.getStorageKey(), JSON.stringify(formObject));
                this.formHasSavedState = true;
            },
            
            // Load saved form data from localStorage
            loadFormData() {
                const savedData = localStorage.getItem(this.getStorageKey());
                
                if (savedData) {
                    try {
                        const parsedData = JSON.parse(savedData);
                        
                        // Set form values
                        Object.keys(parsedData).forEach(key => {
                            // Skip non-form fields
                            if (key !== 'currentStep' && key !== 'completedSteps' && key !== 'lastSaved') {
                                const input = document.querySelector(`[name="${key}"]`);
                                if (input) {
                                    // Skip file inputs - they can't be set programmatically
                                    if (input.type === 'file') {
                                        return;
                                    }
                                    
                                    if (input.tagName === 'TEXTAREA') {
                                        input.textContent = parsedData[key];
                                    }
                                    input.value = parsedData[key];
                                }
                            }
                        });
                        
                        // Restore state
                        if (parsedData.currentStep) {
                            this.currentStep = parsedData.currentStep;
                        }
                        
                        if (parsedData.completedSteps) {
                            this.completedSteps = parsedData.completedSteps;
                        }
                        
                        this.formHasSavedState = true;
                        this.showNotification('Your progress has been loaded', 'success');
                    } catch (e) {
                        console.error('Error loading saved data', e);
                        // If there's an error parsing the saved data, clear it
                        localStorage.removeItem(this.getStorageKey());
                    }
                }
            },
            
            // Get localStorage key with user ID
            getStorageKey() {
                return `applicationDraft_${this.userId}`;
            },
            
            // Reset the form completely
            resetForm() {
                // Clear localStorage
                localStorage.removeItem(this.getStorageKey());
                
                // Reset form fields
                document.getElementById('applicationForm').reset();
                
                // Reset step and completion status
                this.currentStep = 1;
                this.completedSteps = [false, false, false, false, false, false, false];
                this.formHasSavedState = false;
                
                this.showNotification('Form has been reset', 'info');
            },
            
            // Go to specific step
            goToStep(step) {
                // Check if we can navigate to this step
                const canNavigate = step === 1 || this.completedSteps.slice(0, step - 1).every(status => status);
                
                if (canNavigate) {
                    // Add transition effect
                    const formCard = this.$refs.formCard;
                    formCard.classList.add('slide-out-right');
                    
                    setTimeout(() => {
                        this.currentStep = step;
                        formCard.classList.remove('slide-out-right');
                        formCard.classList.add('slide-in-left');
                        
                        setTimeout(() => {
                            formCard.classList.remove('slide-in-left');
                        }, 500);
                    }, 300);
                } else {
                    // Shake the step indicator to show it's locked
                    const step_indicator = document.querySelector(`.step-${step}`);
                    step_indicator.classList.add('animate__animated', 'animate__headShake');
                    
                    setTimeout(() => {
                        step_indicator.classList.remove('animate__animated', 'animate__headShake');
                    }, 1000);
                    
                    // Show notification that step is locked
                    this.showNotification('Please complete the current step first', 'warning');
                }
            },
            
            nextStep() {
                // Validate current step before proceeding
                if (!this.isStepValid(this.currentStep - 1)) {
                    this.showNotification('Please correct the errors before proceeding', 'error');
                    return;
                }
                
                if (this.currentStep < this.totalSteps) {
                    this.completedSteps[this.currentStep - 1] = true;
                    this.currentStep++;
                    this.saveFormData();
                }
            },
            
            previousStep() {
                if (this.currentStep > 1) {
                    // Add transition effect
                    const formCard = this.$refs.formCard;
                    formCard.classList.add('slide-out-right');
                    
                    setTimeout(() => {
                        this.currentStep--;
                        formCard.classList.remove('slide-out-right');
                        formCard.classList.add('slide-in-left');
                        
                        setTimeout(() => {
                            formCard.classList.remove('slide-in-left');
                        }, 500);
                    }, 300);
                }
            },
            
            submitForm() {
                // Final validation of all steps
                let isValid = true;
                
                for (let i = 0; i < this.steps.length; i++) {
                    if (!this.isStepValid(i)) {
                        isValid = false;
                        this.completedSteps[i] = false;
                    }
                }
                
                if (!isValid) {
                    this.showNotification('Please complete all required fields before submitting', 'error');
                    return;
                }
                
                // Set submitting state
                this.isSubmitting = true;
                
                // Show loading notification
                this.showNotification('Submitting your application...', 'info');
                
                // Clear saved draft when submitting
                localStorage.removeItem(this.getStorageKey());
                
                // Get the form element
                const form = document.getElementById('applicationForm');
                
                // Create and append a hidden field to track submission via AJAX
                const hiddenField = document.createElement('input');
                hiddenField.type = 'hidden';
                hiddenField.name = 'ajax_submission';
                hiddenField.value = '1';
                form.appendChild(hiddenField);
                
                // Submit the form directly
                form.submit();
            },
            
            showNotification(message, type = 'info') {
                // Use the global notification system
                if (typeof window.showNotification === 'function') {
                    window.showNotification(message, type);
                } else {
                    // Fallback if global notification system isn't available
                    const notification = document.createElement('div');
                    
                    // Set type-based classes
                    let bgColor, textColor;
                    switch(type) {
                        case 'success':
                            bgColor = 'bg-green-500';
                            textColor = 'text-white';
                            break;
                        case 'error':
                            bgColor = 'bg-red-500';
                            textColor = 'text-white';
                            break;
                        case 'warning':
                            bgColor = 'bg-yellow-500';
                            textColor = 'text-white';
                            break;
                        default:
                            bgColor = 'bg-blue-500';
                            textColor = 'text-white';
                    }
                    
                    notification.className = `fixed bottom-4 right-4 ${bgColor} ${textColor} px-6 py-3 rounded-md shadow-lg animate__animated animate__fadeInUp z-50`;
                    notification.innerHTML = message;
                    
                    document.body.appendChild(notification);
                    
                    // Remove after 3 seconds
                    setTimeout(() => {
                        notification.classList.remove('animate__fadeInUp');
                        notification.classList.add('animate__fadeOutDown');
                        
                        setTimeout(() => {
                            if (document.body.contains(notification)) {
                                document.body.removeChild(notification);
                            }
                        }, 500);
                    }, 3000);
                }
            }
        }));
    });
</script>
@endsection
