// Royal Mail Tracking Page JavaScript

document.addEventListener('DOMContentLoaded', function() {
    
    // Tracking form elements
    const trackingForm = document.getElementById('trackingForm');
    const trackingInput = document.getElementById('trackingInput');
    const trackingResults = document.getElementById('trackingResults');
    const trackingNumber = document.getElementById('trackingNumber');
    const trackingStatus = document.getElementById('trackingStatus');
    const estimatedDelivery = document.getElementById('estimatedDelivery');
    const trackingTimeline = document.getElementById('trackingTimeline');

    // Sample tracking data for demonstration
    const sampleTrackingData = {
        'RR123456789GB': {
            status: 'Delivered',
            statusClass: 'bg-success',
            estimatedDelivery: 'Delivered on 15 Jan 2025 at 2:30 PM',
            serviceType: 'Special Delivery Guaranteed',
            sender: {
                company: 'Amazon UK Services Ltd',
                contact: 'Customer Service Team',
                address: 'Amazon Fulfillment Centre<br>1 Principal Place<br>London, EC2A 2FA',
                phone: '0800 279 7234',
                email: 'customer-service@amazon.co.uk',
                reference: 'AMZ-2025-001234'
            },
            receiver: {
                name: 'John Smith',
                title: 'Mr.',
                address: '123 Main Street<br>Apartment 4B<br>London, SW1A 1AA',
                phone: '+44 7700 900123',
                email: 'john.smith@email.com',
                instructions: 'Leave with neighbour if not available'
            },
            parcel: {
                type: 'Medium Parcel',
                weight: '1.2 kg',
                dimensions: '30cm x 20cm x 10cm',
                contents: 'Electronics - Mobile Phone Case',
                value: '£25.99',
                insurance: '£500.00',
                postage: '£8.95',
                signature: true,
                ageVerification: false
            },
            location: {
                current: 'Delivered',
                facility: 'London Central DO',
                address: '45 Delivery Road<br>London, SW1A 2BB',
                distance: '0 miles - Delivered',
                postcode: 'SW1A',
                round: 'Round 15B'
            },
            timeline: [
                {
                    date: '15 Jan 2025',
                    time: '2:30 PM',
                    status: 'Delivered',
                    description: 'Item delivered to recipient',
                    location: 'Your address',
                    icon: 'fas fa-check-circle',
                    iconClass: 'text-success'
                },
                {
                    date: '15 Jan 2025',
                    time: '8:45 AM',
                    status: 'Out for delivery',
                    description: 'Item out for delivery',
                    location: 'Local delivery office',
                    icon: 'fas fa-truck',
                    iconClass: 'text-primary'
                },
                {
                    date: '14 Jan 2025',
                    time: '6:20 PM',
                    status: 'In transit',
                    description: 'Item in transit',
                    location: 'Regional sorting facility',
                    icon: 'fas fa-shipping-fast',
                    iconClass: 'text-info'
                },
                {
                    date: '13 Jan 2025',
                    time: '11:15 AM',
                    status: 'Processed',
                    description: 'Item processed at facility',
                    location: 'Mail centre',
                    icon: 'fas fa-cog',
                    iconClass: 'text-secondary'
                }
            ]
        },
        'CP987654321GB': {
            status: 'Out for delivery',
            statusClass: 'bg-primary',
            estimatedDelivery: 'Today by 6:00 PM',
            timeline: [
                {
                    date: '16 Jan 2025',
                    time: '8:30 AM',
                    status: 'Out for delivery',
                    description: 'Item out for delivery',
                    location: 'Local delivery office',
                    icon: 'fas fa-truck',
                    iconClass: 'text-primary'
                },
                {
                    date: '15 Jan 2025',
                    time: '7:45 PM',
                    status: 'In transit',
                    description: 'Item in transit',
                    location: 'Regional sorting facility',
                    icon: 'fas fa-shipping-fast',
                    iconClass: 'text-info'
                },
                {
                    date: '14 Jan 2025',
                    time: '2:30 PM',
                    status: 'Processed',
                    description: 'Item processed at facility',
                    location: 'Mail centre',
                    icon: 'fas fa-cog',
                    iconClass: 'text-secondary'
                }
            ]
        },
        'EE555666777GB': {
            status: 'In transit',
            statusClass: 'bg-info',
            estimatedDelivery: 'Tomorrow by 1:00 PM',
            timeline: [
                {
                    date: '15 Jan 2025',
                    time: '11:20 PM',
                    status: 'In transit',
                    description: 'Item in transit',
                    location: 'Regional sorting facility',
                    icon: 'fas fa-shipping-fast',
                    iconClass: 'text-info'
                },
                {
                    date: '14 Jan 2025',
                    time: '4:15 PM',
                    status: 'Processed',
                    description: 'Item processed at facility',
                    location: 'Mail centre',
                    icon: 'fas fa-cog',
                    iconClass: 'text-secondary'
                },
                {
                    date: '13 Jan 2025',
                    time: '9:00 AM',
                    status: 'Collected',
                    description: 'Item collected from sender',
                    location: 'Collection point',
                    icon: 'fas fa-box',
                    iconClass: 'text-warning'
                }
            ]
        }
    };

    // Handle form submission
    if (trackingForm) {
        trackingForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const trackingCode = trackingInput.value.trim().toUpperCase();
            
            if (!trackingCode) {
                showError('Please enter a tracking number');
                return;
            }
            
            if (!validateTrackingNumber(trackingCode)) {
                showError('Please enter a valid tracking number (10-20 characters)');
                return;
            }
            
            // Show loading state
            showLoading();
            
            // Simulate API call delay
            setTimeout(() => {
                displayTrackingResults(trackingCode);
            }, 1500);
        });
    }

    // Validate tracking number format
    function validateTrackingNumber(trackingNumber) {
        const regex = /^[A-Z]{2}[0-9]{9}[A-Z]{2}$|^[A-Z0-9]{10,20}$/;
        return regex.test(trackingNumber);
    }

    // Show loading state
    function showLoading() {
        const loadingHtml = `
            <div class="text-center py-5">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
                <p class="mt-3">Searching for your item...</p>
            </div>
        `;
        
        trackingResults.innerHTML = loadingHtml;
        trackingResults.classList.remove('d-none');
        
        // Scroll to results
        trackingResults.scrollIntoView({ behavior: 'smooth' });
    }

    // Display tracking results
    function displayTrackingResults(trackingCode) {
        const data = sampleTrackingData[trackingCode];

        if (!data) {
            showNotFound(trackingCode);
            return;
        }

        // Update tracking summary
        trackingNumber.textContent = `Tracking Number: ${trackingCode}`;
        trackingStatus.textContent = data.status;
        trackingStatus.className = `badge ${data.statusClass}`;
        estimatedDelivery.textContent = data.estimatedDelivery;

        // Update service type
        const serviceTypeElement = document.getElementById('serviceType');
        if (serviceTypeElement) {
            serviceTypeElement.textContent = data.serviceType;
        }

        // Update sender information
        updateSenderInfo(data.sender);

        // Update receiver information
        updateReceiverInfo(data.receiver);

        // Update parcel information
        updateParcelInfo(data.parcel);

        // Update location information
        updateLocationInfo(data.location);

        // Build timeline
        buildTimeline(data.timeline);

        // Show results
        trackingResults.classList.remove('d-none');
        trackingResults.scrollIntoView({ behavior: 'smooth' });
    }

    // Update sender information
    function updateSenderInfo(sender) {
        const elements = {
            'senderCompany': sender.company,
            'senderContact': sender.contact,
            'senderAddress': sender.address,
            'senderPhone': sender.phone,
            'senderEmail': sender.email,
            'senderRef': sender.reference
        };

        Object.keys(elements).forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.innerHTML = elements[id];
            }
        });
    }

    // Update receiver information
    function updateReceiverInfo(receiver) {
        const elements = {
            'receiverName': receiver.name,
            'receiverTitle': receiver.title,
            'receiverAddress': receiver.address,
            'receiverPhone': receiver.phone,
            'receiverEmail': receiver.email,
            'specialInstructions': receiver.instructions
        };

        Object.keys(elements).forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.innerHTML = elements[id];
            }
        });
    }

    // Update parcel information
    function updateParcelInfo(parcel) {
        const elements = {
            'packageType': parcel.type,
            'packageWeight': parcel.weight,
            'packageDimensions': parcel.dimensions,
            'packageContents': parcel.contents,
            'packageValue': parcel.value,
            'insuranceValue': parcel.insurance,
            'postagePaid': parcel.postage
        };

        Object.keys(elements).forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.textContent = elements[id];
            }
        });

        // Update signature required
        const signatureElement = document.getElementById('signatureRequired');
        if (signatureElement) {
            signatureElement.innerHTML = parcel.signature ?
                '<span class="badge bg-success">Yes</span>' :
                '<span class="badge bg-secondary">No</span>';
        }

        // Update age verification
        const ageElement = document.getElementById('ageVerification');
        if (ageElement) {
            ageElement.innerHTML = parcel.ageVerification ?
                '<span class="badge bg-warning">Required</span>' :
                '<span class="badge bg-secondary">Not Required</span>';
        }
    }

    // Update location information
    function updateLocationInfo(location) {
        const elements = {
            'currentLocation': location.current,
            'facilityName': location.facility,
            'facilityAddress': location.address,
            'distanceToDestination': location.distance,
            'postcodeArea': location.postcode,
            'deliveryRound': location.round
        };

        Object.keys(elements).forEach(id => {
            const element = document.getElementById(id);
            if (element) {
                element.innerHTML = elements[id];
            }
        });
    }

    // Build tracking timeline
    function buildTimeline(timelineData) {
        let timelineHtml = '';
        
        timelineData.forEach((item, index) => {
            const isLast = index === timelineData.length - 1;
            
            timelineHtml += `
                <div class="timeline-item ${isLast ? 'timeline-item-last' : ''}">
                    <div class="timeline-marker">
                        <i class="${item.icon} ${item.iconClass}"></i>
                    </div>
                    <div class="timeline-content">
                        <div class="timeline-header">
                            <h6 class="timeline-title mb-1">${item.status}</h6>
                            <small class="text-muted">${item.date} at ${item.time}</small>
                        </div>
                        <p class="timeline-description mb-1">${item.description}</p>
                        <small class="text-muted">
                            <i class="fas fa-map-marker-alt me-1"></i>${item.location}
                        </small>
                    </div>
                </div>
            `;
        });
        
        trackingTimeline.innerHTML = timelineHtml;
    }

    // Show not found message
    function showNotFound(trackingCode) {
        const notFoundHtml = `
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="alert alert-warning text-center">
                            <i class="fas fa-exclamation-triangle fa-3x mb-3"></i>
                            <h4>Tracking number not found</h4>
                            <p>We couldn't find any information for tracking number: <strong>${trackingCode}</strong></p>
                            <p>Please check the number and try again, or contact customer service for assistance.</p>
                            <button class="btn btn-primary" onclick="location.reload()">Try Again</button>
                        </div>
                    </div>
                </div>
            </div>
        `;
        
        trackingResults.innerHTML = notFoundHtml;
        trackingResults.classList.remove('d-none');
        trackingResults.scrollIntoView({ behavior: 'smooth' });
    }

    // Show error message
    function showError(message) {
        // Remove existing alerts
        const existingAlert = document.querySelector('.alert-danger');
        if (existingAlert) {
            existingAlert.remove();
        }
        
        const alertHtml = `
            <div class="alert alert-danger alert-dismissible fade show mt-3" role="alert">
                <i class="fas fa-exclamation-circle me-2"></i>${message}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        `;
        
        trackingForm.insertAdjacentHTML('afterend', alertHtml);
    }

    // Auto-format tracking number input
    if (trackingInput) {
        trackingInput.addEventListener('input', function() {
            // Convert to uppercase and remove spaces
            this.value = this.value.toUpperCase().replace(/\s/g, '');
        });
        
        // Clear results when input changes
        trackingInput.addEventListener('input', function() {
            if (this.value.length === 0) {
                trackingResults.classList.add('d-none');
            }
        });
    }

    // Check URL parameters for tracking number
    const urlParams = new URLSearchParams(window.location.search);
    const trackingParam = urlParams.get('tracking');
    if (trackingParam && trackingInput) {
        trackingInput.value = trackingParam;
        trackingForm.dispatchEvent(new Event('submit'));
    }

    console.log('Royal Mail tracking page initialized');
});
