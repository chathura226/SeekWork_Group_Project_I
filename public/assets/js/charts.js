function fetchChartData(url,lastearnings){
    //getting data from backend
    fetch(url)
        .then(response => {
            // Check if the request was successful (status code 2xx)
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            // console.log(response.text())

            // Parse the response as JSON
            return response.json();
        })
        .then(lastearnings)
        .catch(error => {
            // Handle any errors that occurred during the fetch
            console.error('Fetch error:', error);
        });
}