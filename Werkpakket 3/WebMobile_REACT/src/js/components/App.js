import React from "react"
import { Link } from "react-router"

import NavBar from "./NavBar"
import Overview from "./Overview"

import { fetchCustomer } from "../actions/customerActions"
import { fetchReports } from "../actions/reportActions"

export default class App extends React.Component {
  render() {
    return <div>
          <NavBar />
          {this.props.children}
    </div>
  }
}
