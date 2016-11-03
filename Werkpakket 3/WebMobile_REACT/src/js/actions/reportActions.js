import axios from "axios";

export function fetchReports(id = 2) {
  return function(dispatch) {
    axios.get("http://www.jonasstams.be/api/public/reports/" + id)
      .then((response) => {
        dispatch({type: "FETCH_REPORTS_FULFILLED", payload: response.data})
      })
      .catch((err) => {
        dispatch({type: "FETCH_REPORTS_REJECTED", payload: err})
      })
  }
}