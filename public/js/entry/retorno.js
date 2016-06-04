var SearchPanel = React.createClass({
    getInitialState: function() {
        return {
            'loaded': false
        }
    },

    render: function() {
        return (
            <div className="row">
                <div className="col-md-4">
                    <label className="control-label col-md-4" forHtml="cliente">
                        Cliente:
                    </label>
                    <div className="input-group col-md-8">
                        <input type="text" ref="customer" className="form-control" onBlur={this.onSearchChanged} />
                    </div>
                </div>
                <div className="col-md-4">
                    <label className="control-label col-md-4" forHtml="cliente">
                        Desde:
                    </label>
                    <div className="input-group col-md-8">
                        <input type="date" ref="start" className="form-control" value={this.props.start} />
                    </div>
                </div>
                <div className="col-md-4">
                    <label className="control-label col-md-4" forHtml="cliente">
                        Hasta:
                    </label>
                    <div className="input-group col-md-8">
                        <input type="date" ref="end" className="form-control" value={this.props.end} />
                    </div>
                </div>
            </div>
        );
    },
    componentDidUpdate: function() {
        if (this.props.customers.length > 0 && ! this.state.loaded) {
            setTypeAHead(this.refs.customer, this.props.customers);
            this.setState({ loaded: true });
        }
    },
    onSearchChanged: function() {
        var customer_name = this.refs.customer.value;
        this.props.onSearchChanged(customer_name);
    }
});

var DevolutionComment = React.createClass({
    render: function() {
        return <div className="form-group">
            <label className="control-label col-md-3 col-sm-3 col-xs-12" forHtml="observacion">
                Observaciones:
            </label>
            <div className="input-group col-md-6 col-sm-6 col-xs-12">
                <input  id="comment_rental" className="form-control col-md-7 col-xs-12" />
            </div>
        </div>
    }
});

var RentalsTableRow = React.createClass({
    render: function() {
        return (<tr>
                <th scope="row">{this.props.i}</th>
                <td>{this.props.id}</td>
                <td>{this.props.start}</td>
                <td>{this.props.days}</td>
                <td>{this.props.state}</td>
                <td>
                    <button type="button" className="btn btn-primary btn-sm" onClick={this.onClickTotal}>Total</button>
                    <button type="button" className="btn btn-info btn-sm" onClick={this.onClickPartial}>Parcial</button>
                </td>
            </tr>
        );
    },
    onClickTotal: function() {
        this.props.handleDevolutionTotal(this.props.id);
    },
    onClickPartial: function() {
        alert('En construcción');
    }
});

var RentalsTable = React.createClass({
    render: function() {
        var rows = [];
        this.props.rentals.forEach(function(rental) {
            rows.push(
                <RentalsTableRow
                key={rental.id}
                i={1}
                id={rental.id}
                start={rental.fechaAlquiler}
                days={rental.rental_days}
                state={rental.rental_state}
                handleDevolutionTotal={this.props.handleDevolutionTotal} />
            );
        }.bind(this));

        return (<div className="col-md-8 col-md-offset-2 col-sm-12">
                <table className="table table-hover table-condensed">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Alquiler</th>
                        <th>Fecha alquiler</th>
                        <th>Días alquilados</th>
                        <th>Estado</th>
                        <th>Acción</th>
                    </tr>
                    </thead>
                    <tbody>
                    {rows}
                    </tbody>
                </table>
            </div>
        );
    }
});

var RentalActions = React.createClass({
   render: function () {
       return <div className="form-group">
           <div className="col-md-6 col-sm-6 col-xs-12 col-md-offset-5">
               <button type="submit" className="btn btn-primary">Retornar</button>
               <button type="reset" className="btn btn-danger">Cancelar</button>
           </div>
       </div>
   }
});

var DevolutionPanel = React.createClass({
    getInitialState: function() {
        return {
            rentals: [],
            customer_name: '',
            customers: [],
            start: new Date().toISOString().substring(0, 10),
            end: new Date().toISOString().substring(0, 10),
            message: ''
        };
    },
    render: function() {
        return (
            <div className="row">
                <SearchPanel start={this.state.start}
                             end={this.state.end}
                             customers={this.state.customers}
                             onSearchChanged={this.onSearchChanged} />
                <DevolutionComment />
                <RentalsTable rentals={this.state.rentals} handleDevolutionTotal={this.handleDevolutionTotal} />
                <RentalActions />
            </div>
        );
    },
    componentDidMount: function() {
        this.reloadRentals();
        this.loadClients();
    },

    // Non-ajax object methods
    onSearchChanged: function(customer_name, start, end) {
        if (this.promise) {
            clearInterval(this.promise)
        }
        this.setState({
            customer_name: customer_name
        });
        this.promise = setTimeout(function () {
            this.reloadRentals(customer_name, start, end);
        }.bind(this), 200);
    },

    handleDevolutionTotal: function(id) {
        event.preventDefault();

        var url_request = this.props.url + '/' + id;
        $.ajax({
            url: url_request,
            method: 'POST',
            dataType: 'json',
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            },
            cache: false,
            success: function(data) {
                if (data.success) {
                    alert('La devolución se ha registrado correctamente');
                    this.reloadRentals();
                } else {
                    alert(data.message);
                }
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
                this.setState({
                    message: err.toString()
                });
            }.bind(this)
        });
    },

    handleChange: function(email, name, role, password) {
        this.setState({
            editingUser: {
                email: email,
                name: name,
                role: role,
                password: password,
                id: this.state.editingUser.id
            }
        });
    },

    // Ajax object methods
    reloadRentals: function(customer_name) {
        var url_request = this.props.url;
        if (customer_name)
            url_request += '?customer='+customer_name;

        $.ajax({
            url: url_request,
            dataType: 'json',
            cache: false,
            success: function(data) {
                this.setState({
                    rentals: data
                });
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
                this.setState({
                    message: err.toString()
                });
            }.bind(this)
        });
    },

    loadClients: function() {
        $.ajax({
            url: '../../clientes',
            dataType: 'json',
            cache: false,
            success: function(data) {
                this.setState({
                    customers: data
                });
            }.bind(this),
            error: function(xhr, status, err) {
                console.error(this.props.url, status, err.toString());
                this.setState({
                    message: err.toString()
                });
            }.bind(this)
        });
    }
});

ReactDOM.render(
    <DevolutionPanel url={location.href} />,
    document.getElementById('form')
);

function setTypeAHead(element, data) {
    $(element).typeahead(
        {
            hint: true,
            highlight: true,
            minLength: 1
        },
        {
            name: 'customers',
            source: substringMatcher(data)
        }
    );
}
