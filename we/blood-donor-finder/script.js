document.getElementById('findDonorBtn').addEventListener('click', function() {
    const bloodType = document.getElementById('bloodType').value;
    const location = document.getElementById('location').value;

    const resultsSection = document.getElementById('results');
    resultsSection.innerHTML = `<p>Searching for donors with blood type <strong>${bloodType}</strong> in <strong>${location}</strong>...</p>`;

    // Sample donors data for demonstration
    const donors = [
        { name: 'John Doe', bloodType: 'A+', location: 'New York', lastDonation: '2 months ago' },
        { name: 'Jane Smith', bloodType: 'O-', location: 'Los Angeles', lastDonation: '1 month ago' },
        { name: 'Robert Brown', bloodType: 'B+', location: 'Chicago', lastDonation: '3 weeks ago' }
    ];

    // Simulating search results based on blood type and location
    const filteredDonors = donors.filter(donor => donor.bloodType === bloodType && donor.location.includes(location));

    if (filteredDonors.length > 0) {
        resultsSection.innerHTML += `<ul>`;
        filteredDonors.forEach(donor => {
            resultsSection.innerHTML += `
                <li>${donor.name} (Blood Type: ${donor.bloodType}) - Location: ${donor.location}, Last Donation: ${donor.lastDonation}</li>
            `;
        });
        resultsSection.innerHTML += `</ul>`;
    } else {
        resultsSection.innerHTML += `<p>No donors found.</p>`;
    }
});

// Handling blood request form submission
document.getElementById('request-form').addEventListener('submit', function(e) {
    e.preventDefault();

    const recipientName = document.getElementById('recipientName').value;
    const recipientBloodType = document.getElementById('recipientBloodType').value;
    const emergencyLocation = document.getElementById('emergencyLocation').value;

    alert(`Blood request sent for ${recipientName} with blood type ${recipientBloodType} in ${emergencyLocation}.`);
});
