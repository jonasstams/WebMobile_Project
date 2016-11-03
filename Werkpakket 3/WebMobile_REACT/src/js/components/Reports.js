import React from "react"
import { connect } from "react-redux"

import { fetchCustomer } from "../actions/customerActions"
import { fetchReports } from "../actions/reportActions"

@connect((store) => {
  return {
    customer: store.customer.customer,
    reports: store.reports.reports,
  };
})
export default class Reports extends React.Component {
	componentWillMount() {
	    this.props.dispatch(fetchCustomer(2));
	    this.props.dispatch(fetchReports(2));
  	}

	trueOrFalseIcon(boolValue){
		if(boolValue == 1){
			return "<span class='glyphicon glyphicon-ok' aria-hidden='true'></span>"
		}else{
			return "<span class='glyphicon glyphicon-remove' aria-hidden='true'></span>"
		}
	}

	formatDate(date){
	   const newDate =	new Date(date);
		return newDate.toDateString();
	}
	render() {
		const { customer } = this.props;
		const { reports } = this.props;


		const mappedRows = reports.map(report => <tr>
													<td>{this.formatDate(report.created_at)}</td>
													<td>{report.weight}</td>
													<td>{report.calories}</td>
													<td>
														<ul>
															<li>- {customer.habit1}: <span dangerouslySetInnerHTML={{__html: this.trueOrFalseIcon(report.habit1_done)}}></span> </li>
															<li>- {customer.habit2}: <span dangerouslySetInnerHTML={{__html: this.trueOrFalseIcon(report.habit2_done)}}></span> </li>
															<li>- {customer.habit3}: <span dangerouslySetInnerHTML={{__html: this.trueOrFalseIcon(report.habit3_done)}}></span> </li>
														</ul>
													</td>
												 </tr>);

		return <div id="reports"> 
			<table class="table">
			    <thead>
			      <tr>
			        <th>Date</th>
			        <th>Weight</th>
			        <th>Calories</th>
			        <th>Habits</th>
			      </tr>
			    </thead>
			    <tbody>
			      {mappedRows}
			    </tbody>
			  </table>
			  </div>
	}

}