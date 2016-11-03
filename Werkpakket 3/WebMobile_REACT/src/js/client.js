import React from "react"
import ReactDOM from "react-dom"
import { Provider } from "react-redux"
import { Router, Route, IndexRoute, browserHistory } from 'react-router'

import App from "./components/App"
import Overview from "./components/Overview"
import NavBar from "./components/NavBar"
import Reports from "./components/Reports"
import AddReport from "./components/AddReport"
import store from "./store"


const app = document.getElementById('app')

ReactDOM.render(
	<Provider store={store}>
	  	<Router history={browserHistory}>
	  		<Route path="/" component={App}>
	  			<IndexRoute component={Overview}/>
	  			<Route path="reports" component={Reports}></Route>
	  			<Route path="add" component={AddReport}></Route>
	  		</Route>
	  	</Router>	
 	</Provider>
, app);
