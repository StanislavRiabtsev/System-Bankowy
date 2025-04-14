document.getElementById('conversionForm').addEventListener('submit', function (e) {
    e.preventDefault();

    const formData = new FormData(this);

    fetch('konwert.php', {
        method: 'POST',
        body: formData
    })
        .then(res => res.json())
        .then(data => {
            const resultBox = document.getElementById('resultBox');
            resultBox.innerHTML = `<p class="result">Result: ${data.result} ${data.waluta_do}</p>`;
        })
        .catch(error => {
            console.error('Error:', error);
        });
});
