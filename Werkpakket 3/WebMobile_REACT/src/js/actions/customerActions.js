import axios from "axios";

export function fetchCustomer(id = 2) {
	return function(dispatch) {
    axios.get("http://www.jonasstams.be/api/public/customers/" + id)
      .then((response) => {
        dispatch({type: "FETCH_CUSTOMER_FULFILLED", payload: response.data})
      })
      .catch((err) => {
        dispatch({type: "FETCH_CUSTOMER_REJECTED", payload: err})
      })
  }
}

export function postDailyReportForCustomerByID(id = 0, weight, calories, h1=false, h2=false, h3=false) {
	if(h1 == true) {
		h1 = "1";
	} else {
		h1 = "0";
	}

	if(h2 == true) {
		h2 = "1";
	} else {
		h2 = "0";
	}

	if(h3 == true) {
		h3 = "1";
	} else {
		h3 = "0";
	}

	const json = JSON.stringify({
		weight: weight,
		calories: calories,
		habit1_done: h1,
		habit2_done: h2,
		habit3_done: h3,
	});
	return function(dispatch) {
		axios.post('http://www.jonasstams.be/api/public/reports/' + id, json).then(function (response) {
			    console.log(response);
			  })
	}
}