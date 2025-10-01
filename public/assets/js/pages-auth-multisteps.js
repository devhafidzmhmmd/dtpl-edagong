/**
 *  Page auth register multi-steps
 */

'use strict';

// Select2 (jquery)
$(function () {
  var select2 = $('.select2');

  // select2
  if (select2.length) {
    select2.each(function () {
      var $this = $(this);
      $this.wrap('<div class="position-relative"></div>');
      $this.select2({
        placeholder: 'Select an country',
        dropdownParent: $this.parent()
      });
    });
  }
});

// Multi Steps Validation
// --------------------------------------------------------------------
document.addEventListener('DOMContentLoaded', function (e) {
  (function () {
    const stepsValidation = document.querySelector('#multiStepsValidation');
    if (typeof stepsValidation !== undefined && stepsValidation !== null) {
      // Multi Steps form
      const stepsValidationForm = stepsValidation.querySelector('#multiStepsForm');
      // Form steps
      const stepsValidationFormStep1 = stepsValidationForm.querySelector('#accountDetailsValidation');
      const stepsValidationFormStep2 = stepsValidationForm.querySelector('#personalInfoValidation');
      const stepsValidationFormStep3 = stepsValidationForm.querySelector('#billingLinksValidation');
      // Multi steps next prev button
      const stepsValidationNext = [].slice.call(stepsValidationForm.querySelectorAll('.btn-next'));
      const stepsValidationPrev = [].slice.call(stepsValidationForm.querySelectorAll('.btn-prev'));

      const multiStepsExDate = document.querySelector('.multi-steps-exp-date'),
        multiStepsCvv = document.querySelector('.multi-steps-cvv'),
        multiStepsMobile = document.querySelector('.multi-steps-mobile'),
        multiStepsPincode = document.querySelector('.multi-steps-pincode'),
        multiStepsCard = document.querySelector('.multi-steps-card');

      // Expiry Date Mask
      if (multiStepsExDate) {
        new Cleave(multiStepsExDate, {
          date: true,
          delimiter: '/',
          datePattern: ['m', 'y']
        });
      }

      // CVV
      if (multiStepsCvv) {
        new Cleave(multiStepsCvv, {
          numeral: true,
          numeralPositiveOnly: true
        });
      }

      // Mobile
      if (multiStepsMobile) {
        new Cleave(multiStepsMobile, {
          phone: true,
          phoneRegionCode: 'US'
        });
      }

      // Pincode
      if (multiStepsPincode) {
        new Cleave(multiStepsPincode, {
          delimiter: '',
          numeral: true
        });
      }

      // Credit Card
      if (multiStepsCard) {
        new Cleave(multiStepsCard, {
          creditCard: true,
          onCreditCardTypeChanged: function (type) {
            if (type != '' && type != 'unknown') {
              document.querySelector('.card-type').innerHTML =
                '<img src="' + assetsPath + 'img/icons/payments/' + type + '-cc.png" height="28"/>';
            } else {
              document.querySelector('.card-type').innerHTML = '';
            }
          }
        });
      }

      let validationStepper = new Stepper(stepsValidation, {
        linear: true
      });

      // Account details - Disabled FormValidation temporarily
      /*
      const multiSteps1 = FormValidation.formValidation(stepsValidationFormStep1, {
        fields: {
          multiStepsEmail: {
            validators: {
              notEmpty: {
                message: 'Please enter email address'
              },
              emailAddress: {
                message: 'The value is not a valid email address'
              }
            }
          },
          multiStepsPass: {
            validators: {
              notEmpty: {
                message: 'Please enter password'
              }
            }
          },
          multiStepsConfirmPass: {
            validators: {
              notEmpty: {
                message: 'Confirm Password is required'
              },
              identical: {
                compare: function () {
                  return stepsValidationFormStep1.querySelector('[name="multiStepsPass"]').value;
                },
                message: 'The password and its confirm are not the same'
              }
            }
          },
          multiStepsURL: {
            validators: {
              notEmpty: {
                message: 'Please enter store name'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            // Use this for enabling/changing valid/invalid class
            // eleInvalidClass: '',
            eleValidClass: '',
            rowSelector: '.col-sm-6, .col-sm-12, .col-md-6, .col-md-12'
          }),
          autoFocus: new FormValidation.plugins.AutoFocus(),
          submitButton: new FormValidation.plugins.SubmitButton()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      }).on('core.form.valid', function () {
        // Jump to the next step when all fields in the current step are valid
        validationStepper.next();
      });
      */

      // Personal info - Disabled FormValidation temporarily
      /*
      const multiSteps2 = FormValidation.formValidation(stepsValidationFormStep2, {
        fields: {
          multiStepsFirstName: {
            validators: {
              notEmpty: {
                message: 'Please enter first name'
              }
            }
          },
          multiStepsLastName: {
            validators: {
              notEmpty: {
                message: 'Please enter last name'
              }
            }
          },
          multiStepsMobile: {
            validators: {
              notEmpty: {
                message: 'Please enter mobile number'
              }
            }
          },
          multiStepsPincode: {
            validators: {
              notEmpty: {
                message: 'Please enter postal code'
              }
            }
          },
          multiStepsAddress: {
            validators: {
              notEmpty: {
                message: 'Please enter your address'
              }
            }
          },
          multiStepsArea: {
            validators: {
              notEmpty: {
                message: 'Please enter area landmark'
              }
            }
          },
          multiStepsCity: {
            validators: {
              notEmpty: {
                message: 'Please enter city'
              }
            }
          },
          multiStepsState: {
            validators: {
              notEmpty: {
                message: 'Please select province'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            // Use this for enabling/changing valid/invalid class
            // eleInvalidClass: '',
            eleValidClass: '',
            rowSelector: '.col-sm-6, .col-sm-12, .col-md-6, .col-md-12'
          }),
          autoFocus: new FormValidation.plugins.AutoFocus(),
          submitButton: new FormValidation.plugins.SubmitButton()
        }
      }).on('core.form.valid', function () {
        // Jump to the next step when all fields in the current step are valid
        validationStepper.next();
      });
      */

      // Store info - Disabled FormValidation temporarily
      /*
      const multiSteps3 = FormValidation.formValidation(stepsValidationFormStep3, {
        fields: {
          umkmCategory: {
            validators: {
              notEmpty: {
                message: 'Please select UMKM category'
              }
            }
          },
          productCategory: {
            validators: {
              notEmpty: {
                message: 'Please select product category'
              }
            }
          },
          storeOwnerName: {
            validators: {
              notEmpty: {
                message: 'Please enter store owner name'
              }
            }
          },
          ktpNumber: {
            validators: {
              notEmpty: {
                message: 'Please enter KTP number'
              },
              stringLength: {
                min: 16,
                max: 16,
                message: 'KTP number must be 16 digits'
              }
            }
          },
          storeDescription: {
            validators: {
              notEmpty: {
                message: 'Please enter store description'
              }
            }
          },
          termsCheck: {
            validators: {
              notEmpty: {
                message: 'Please accept terms and conditions'
              }
            }
          },
          verificationCheck: {
            validators: {
              notEmpty: {
                message: 'Please accept verification'
              }
            }
          }
        },
        plugins: {
          trigger: new FormValidation.plugins.Trigger(),
          bootstrap5: new FormValidation.plugins.Bootstrap5({
            // Use this for enabling/changing valid/invalid class
            // eleInvalidClass: '',
            eleValidClass: '',
            rowSelector: '.col-sm-6, .col-sm-12, .col-md-6, .col-md-12'
          }),
          autoFocus: new FormValidation.plugins.AutoFocus(),
          submitButton: new FormValidation.plugins.SubmitButton()
        },
        init: instance => {
          instance.on('plugins.message.placed', function (e) {
            if (e.element.parentElement.classList.contains('input-group')) {
              e.element.parentElement.insertAdjacentElement('afterend', e.messageElement);
            }
          });
        }
      }).on('core.form.valid', function () {
        // Form is valid, trigger our custom submit function
        if (typeof submitForm === 'function') {
          submitForm();
        }
      });
      */

      stepsValidationNext.forEach(item => {
        item.addEventListener('click', event => {
          // Simple validation without FormValidation
          let isValid = true;
          
          switch (validationStepper._currentIndex) {
            case 0:
              // Validate step 1 - Account details
              const email = document.querySelector('[name="multiStepsEmail"]');
              const password = document.querySelector('[name="multiStepsPass"]');
              const confirmPassword = document.querySelector('[name="multiStepsConfirmPass"]');
              const storeName = document.querySelector('[name="multiStepsURL"]');
              
              if (!email.value || !email.value.includes('@')) {
                alert('Please enter a valid email address');
                isValid = false;
              } else if (!password.value || password.value.length < 8) {
                alert('Password must be at least 8 characters');
                isValid = false;
              } else if (password.value !== confirmPassword.value) {
                alert('Passwords do not match');
                isValid = false;
              } else if (!storeName.value) {
                alert('Please enter store name');
                isValid = false;
              }
              break;

            case 1:
              // Validate step 2 - Personal info
              const firstName = document.querySelector('[name="multiStepsFirstName"]');
              const lastName = document.querySelector('[name="multiStepsLastName"]');
              const mobile = document.querySelector('[name="multiStepsMobile"]');
              const pincode = document.querySelector('[name="multiStepsPincode"]');
              const address = document.querySelector('[name="multiStepsAddress"]');
              
              if (!firstName.value) {
                alert('Please enter first name');
                isValid = false;
              } else if (!lastName.value) {
                alert('Please enter last name');
                isValid = false;
              } else if (!mobile.value) {
                alert('Please enter mobile number');
                isValid = false;
              } else if (!pincode.value || pincode.value.length !== 5) {
                alert('Please enter a valid 5-digit postal code');
                isValid = false;
              } else if (!address.value) {
                alert('Please enter address');
                isValid = false;
              }
              break;

            case 2:
              // Validate step 3 - Store info
              const umkmCategory = document.querySelector('[name="umkmCategory"]:checked');
              const productCategory = document.querySelector('[name="productCategory"]');
              const storeOwnerName = document.querySelector('[name="storeOwnerName"]');
              const ktpNumber = document.querySelector('[name="ktpNumber"]');
              const storeDescription = document.querySelector('[name="storeDescription"]');
              const termsCheck = document.querySelector('[name="termsCheck"]');
              const verificationCheck = document.querySelector('[name="verificationCheck"]');
              
              if (!umkmCategory) {
                alert('Please select UMKM category');
                isValid = false;
              } else if (!productCategory.value) {
                alert('Please select product category');
                isValid = false;
              } else if (!storeOwnerName.value) {
                alert('Please enter store owner name');
                isValid = false;
              } else if (!ktpNumber.value || ktpNumber.value.length !== 16) {
                alert('Please enter a valid 16-digit KTP number');
                isValid = false;
              } else if (!storeDescription.value) {
                alert('Please enter store description');
                isValid = false;
              } else if (!termsCheck.checked) {
                alert('Please accept terms and conditions');
                isValid = false;
              } else if (!verificationCheck.checked) {
                alert('Please accept verification');
                isValid = false;
              }
              break;

            default:
              break;
          }
          
          if (isValid) {
            validationStepper.next();
          }
        });
      });

      stepsValidationPrev.forEach(item => {
        item.addEventListener('click', event => {
          switch (validationStepper._currentIndex) {
            case 2:
              validationStepper.previous();
              break;

            case 1:
              validationStepper.previous();
              break;

            case 0:

            default:
              break;
          }
        });
      });
    }
  })();
});
