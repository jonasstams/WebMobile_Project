export default function reducer(state={
    customer: {
      id: null,
      first_name: null,
      last_name: null,
      habit1: null,
      habit2: null,
      habit3: null,
        profile_picture_url: null,
    },
    fetching: false,
    fetched: false,
    error: null,
  }, action) {

    switch (action.type) {
      case "FETCH_CUSTOMER": {
        return {...state, fetching: true}
      }
      case "FETCH_CUSTOMER_REJECTED": {
        return {...state, fetching: false, error: action.payload}
      }
      case "FETCH_CUSTOMER_FULFILLED": {
        return {
          ...state,
          fetching: false,
          fetched: true,
          customer: action.payload,
        }
      }
    }
    return state
}
