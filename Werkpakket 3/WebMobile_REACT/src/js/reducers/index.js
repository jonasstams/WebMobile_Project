import { combineReducers } from "redux"
import { routerReducer } from 'react-router-redux'

import customer from "./customerReducer"
import reports from "./reportReducer"

export default combineReducers({
	customer,
  	reports,
  	routing: routerReducer,
})
