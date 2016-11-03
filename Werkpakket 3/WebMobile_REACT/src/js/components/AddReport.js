import React from "react"
import { connect } from "react-redux"

import { fetchCustomer } from "../actions/customerActions"
import { postDailyReportForCustomerByID } from "../actions/customerActions"

@connect((store) => {
  return {
    customer: store.customer.customer,
  };
})
export default class AddReport extends React.Component {
	constructor(props) {
	    super(props);
	    this.handleSubmit = this.handleSubmit.bind(this);
  	}

  	handleSubmit(event) {
  		var id = document.getElementById('id').value;
  		var weight = document.getElementById('weight').value;
  		var calories = document.getElementById('calories').value;
  		var habit1_done = document.getElementById('habit1').checked;
  		var habit2_done = document.getElementById('habit2').checked;
  		var habit3_done = document.getElementById('habit3').checked;

  		this.props.dispatch(postDailyReportForCustomerByID(id,
													  		weight,
													  		calories,
													  		habit1_done,
													  		habit2_done,
													  		habit3_done));
  	}

	componentWillMount() {
	    this.props.dispatch(fetchCustomer(2));
  	}

	render() {
		const { customer } = this.props;

		return <div id="addReport">
			<input type="hidden" id="id" value={customer.id}/>
			<h2>Weight</h2>
			<input type="text" id="weight" class="form-control" placeholder="Current weight..."/>
			<h2>Calories</h2>
			<input type="text" id="calories" class="form-control" placeholder="Calories..."/>


			<div class="[ form-group ]">
	            <input type="checkbox" name="habit1" id="habit1" autocomplete="off" />
	            <div class="btn-group">
	                <label for="habit1" class="[ btn btn-default ]">
	                    <span class="[ glyphicon glyphicon-ok ]"></span>
	                    <span> </span>
	                </label>
	                <label for="habit1" class="[ btn btn-default active ]">
	                    {customer.habit1}
	                </label>
	            </div>
        	</div>

        	<div class="[ form-group ]">
	            <input type="checkbox" name="habit2" id="habit2" autocomplete="off" />
	            <div class="btn-group">
	                <label for="habit2" class="[ btn btn-default ]">
	                    <span class="[ glyphicon glyphicon-ok ]"></span>
	                    <span> </span>
	                </label>
	                <label for="habit2" class="[ btn btn-default active ]">
	                    {customer.habit2}
	                </label>
	            </div>
        	</div>

        	<div class="[ form-group ]">
	            <input type="checkbox" name="habit3" id="habit3" autocomplete="off" />
	            <div class="btn-group">
	                <label for="habit3" class="[ btn btn-default ]">
	                    <span class="[ glyphicon glyphicon-ok ]"></span>
	                    <span> </span>
	                </label>
	                <label for="habit3" class="[ btn btn-default active ]">
	                    {customer.habit3}
	                </label>
	            </div>
        	</div>
        	<button class="btn btn-default linkButton" onClick={this.handleSubmit}>Post daily report!</button>
		</div>
	}

}