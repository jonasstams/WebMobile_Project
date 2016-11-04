import React from "react"
import { connect } from "react-redux"
import { Link } from "react-router"

import { fetchCustomer } from "../actions/customerActions"
import { fetchReports } from "../actions/reportActions"

@connect((store) => {
  return {
    customer: store.customer.customer,
    reports: store.reports.reports,
  };
})
export default class Overview extends React.Component {


	constructor() {
		super();
		this.state = {id: 1};
		console.log(this.id);
		this.changeCustomer = this.changeCustomer.bind(this);
	}


	componentWillMount() {

	  }

	  componentDidMount(){
		  this.props.dispatch(fetchCustomer(this.state.id));
		  this.props.dispatch(fetchReports(this.state.id));
	  }

  changeCustomer(event) {
		var cust_id = document.getElementById('customer_id').value;

	  this.setState({id: cust_id});
	  this.componentDidMount();
	  this.render();
	}

  render() {
  	const { customer } = this.props;
  	const { reports } = this.props;

  	const mappedWeights = reports.map(report => <span>{report.weight}</span>);
  	const mappedCalories = reports.map(report => <span>{report.calories}</span>);

  	const currentWeight = mappedWeights[mappedWeights.length-1];
  	const currentCalories = mappedCalories[mappedCalories.length-1];
	const profilePictureUrl = customer.profile_picture_url;
  	return <div id="mainContent">
		<h2>Change customer: {this.state.id}</h2>
		<input type="text" id="customer_id" class="form-control" placeholder="Customer id"/>
		<button class="btn btn-default linkButton" onClick={this.changeCustomer}>Change customer!</button>
  		<h1>{customer.first_name} {customer.last_name}</h1>
		<h3><span class="glyphicon glyphicon-scale"/></h3>
		<h4>Current weight</h4>
		<h3>{currentWeight}</h3>

		<h3><span class="glyphicon glyphicon-apple"/></h3>
		<h4>Latest calorie intake</h4>
		<h3>{currentCalories}</h3>

		<h3><span class="glyphicon glyphicon-th-list"/></h3>
		<h4>Habits</h4>
  		<ul>
  			<li>{customer.habit1}</li>
  			<li>{customer.habit2}</li>
  			<li>{customer.habit3}</li>
  		</ul>
      <Link to="add"><button class="btn btn-default linkButton">Add report</button></Link>
  	</div>
	}
}