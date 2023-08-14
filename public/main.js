function getAddress(event) {
    event.preventDefault();
    document.getElementById('errorMsg').innerHTML = '';
    document.getElementById('result').innerHTML = '';
    console.log('getAddress')
    const zipCode = document.getElementById('zipCode').value;
    
    fetch('/api/getAddress.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded'
        },
        body: 'zipCode=' + encodeURIComponent(zipCode)
    })
    .then(response => response.text())
    .then(text => {
        if (text.startsWith('Error:')) {
            document.getElementById('errorMsg').innerHTML = text;
        } else {
            document.getElementById('result').innerHTML = text;
            }
        })
    .catch(error => {
        console.error(error);
    });
}


function getHistory(){
    document.getElementById('history').innerHTML = '';
    fetch('/api/getHistory.php')
    .then(response => response.json())
    .then(history => {
        let historyDiv = document.getElementById('history');
        history.forEach(item => {
            let p = document.createElement('p');
            p.textContent = item.zip_code + ' : ' + item.address;
            historyDiv.appendChild(p);
            });       
    })
    .catch(error => {
        console.error(error);
    });
}