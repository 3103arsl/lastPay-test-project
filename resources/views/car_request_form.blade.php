<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>LastPay Car Request</title>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <h1>Request a Car</h1>
    <form id="carRequestForm">
        <label>
            Customer Name:<br />
            <input type="text" name="customer_name" id="customer_name" required />
        </label><br /><br />

        <label>
            Select Car Model:<br />
            <select name="car_model" id="car_model" required>
                <option value="">--Choose--</option>
                <option value="Tesla Model 3">Tesla Model 3</option>
                <option value="Toyota Camry">Toyota Camry</option>
            </select>
        </label><br /><br />

        <button type="submit">Submit Request</button>
    </form>

    <div id="result" style="margin-top: 30px;"></div>

<script>
document.getElementById('carRequestForm').addEventListener('submit', function(e) {
    e.preventDefault();
    const resultDiv = document.getElementById('result');
    resultDiv.innerHTML = 'Loading...';

    const data = {
        customer_name: document.getElementById('customer_name').value,
        car_model: document.getElementById('car_model').value,
    };

    axios.post('/api/car-request', data)
        .then(response => {
            let res = response?.data?.data;
            console.log(res);
            let specsHtml = '<ul>';
            for (const key in res.car_specs) {
                specsHtml += `<li><b>${key}</b>: ${res.car_specs[key]}</li>`;
            }
            specsHtml += '</ul>';

            resultDiv.innerHTML = `
                <h2>Request Summary</h2>
                <p><b>Customer:</b> ${res.customer_name}</p>
                <p><b>Car Model:</b> ${res.car_model}</p>
                <p><b>Price:</b> ${res.car_price}</p>
                <h3>Specs:</h3>
                ${specsHtml}
                <p><b>Insurance Premium:</b> ${res.insurance_premium}</p>
                <p><b>Loan Approval:</b> ${res.loan_approved ? 'Approved' : 'Rejected'}</p>
            `;
        })
        .catch(error => {
            console.log(error);
            if (error.response && error.response.data && error.response.data.errors) {
                let errors = error.response.data.errors;
                let errMsg = '<ul style="color:red;">';
                for (const key in errors) {
                    errors[key].forEach(msg => {
                        errMsg += `<li>${msg}</li>`;
                    });
                }
                errMsg += '</ul>';
                resultDiv.innerHTML = errMsg;
            } else {
                resultDiv.innerHTML = 'An error occurred';
            }
        });
});
</script>
</body>
</html>
