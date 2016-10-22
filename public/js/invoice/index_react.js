var SearchPanel = React.createClass({
    render: function() {
        return (
            <div className="form-inline col-md-8">
                <div className="col-md-8 input-group">
                    <span class="input-group-addon">Filtro</span>
                    <input ref='search' className='form-control' type='text' value={this.props.search} onChange={this.onSearchChanged} />
                    {this.props.search?<button onClick={this.props.onClearSearch}>x</button>:null}
                </div>
            </div>
        )
    },
    onSearchChanged: function() {
        var query = this.refs.search.value;
        this.props.onSearchChanged(query);
    }
});

var InvoiceTableRow = React.createClass({
    render: function() {
        return (
            <tr>
                <td>{this.props.output.invoice}</td>
                <td>{this.props.output.type_doc}</td>
                <td>{this.props.output.invoice_date}</td>
                <td>
                    <button type="button" className="btn btn-danger" data-invoice={this.props.invoice}>
                        <i className="fa fa-pencil"></i> Quitar
                    </button>
                </td>
            </tr>
        );
    },
});

var TablePagination = React.createClass({
    render: function() {
        var prev_button, next_button;

        if (this.props.current_page==1)
            prev_button = <li className="disabled"><span>«</span></li>;
        else prev_button = <li><span>«</span></li>;

        if (this.props.current_page==this.props.last_page)
            next_button = <li className="disabled"><span>»</span></li>;
        else next_button = <li><span>»</span></li>;

        var buttons = [];
        for (var i=1; i<=this.props.last_page; ++i) {
            var button;
            if (i == this.props.current_page)
                button = <li className="active"><span>{this.props.current_page}</span></li>;
            else
                button = <li><a href="#" onClick={this.onPageSelected}>{i}</a></li>;
            buttons.push(button);
        }

        return <ul className="pagination">
            {prev_button}

            {buttons}

            {next_button}
        </ul>
    },
    onPageSelected: function(e) {
        e.preventDefault();

        this.props.handlePageChange(e.currentTarget.innerHTML);
    }
});

var InvoicesTable = React.createClass({
    render: function() {
        var rows = [];
        this.props.outputs.forEach(function(output) {
            rows.push(<InvoiceTableRow key={output.invoice} invoice={output.invoice}
                                       type_doc={output.type_doc} invoice_date={output.invoice_date} />);
        }.bind(this));
        return (
            <table className="table table-condensed table-hover">
                <thead>
                <tr>
                    <th>Documento</th>
                    <th>Tipo documento</th>
                    <th>Fecha de emisión</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>{rows}</tbody>
            </table>
        );
    }
});

var InvoicePanel  = React.createClass({
    getInitialState: function() {
        return {
            outputs: [],
            search:""
        };
    },
    render: function() {
        return(
            <div className="row">
                <div className="col-md-8">
                    <SearchPanel search={this.state.search}
                                 onSearchChanged={this.onSearchChanged}
                                 onClearSearch={this.onClearSearch} />
                    <InvoicesTable outputs={this.state.outputs}
                                   search={this.state.search} />

                    <TablePagination
                        current_page={this.state.current_page}
                        last_page={this.state.last_page}
                        handlePageChange={this.handlePageChange} />
                </div>
            </div>
        );
    },
    componentDidMount: function() {
        this.reloadInvoices('');
    },

    // Non-ajax object methods
    onSearchChanged: function(query) {
        if (this.promise) {
            clearInterval(this.promise)
        }
        this.setState({
            search: query
        });
        this.promise = setTimeout(function () {
            this.reloadInvoices(query);
        }.bind(this), 200);
    },
    onClearSearch: function() {
        this.setState({
            search: ''
        });
        this.reloadInvoices('');
    },
    handleEditClickPanel: function(id) {
        var user = $.extend({}, this.state.users.filter(function(x) {
            return x.id == id;
        })[0] );

        this.setState({
            editingUser: user,
            message: ''
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
    handleCancelClick: function(e) {
        e.preventDefault();
        this.setState({
            editingUser: {}
        });
    },

    // The most OP function XD
    handlePageChange: function(page) {
        this.reloadInvoices(this.state.search, page);
    },

    // Ajax object methods
    reloadInvoices: function(query, page) {
        var url_request = this.props.url+'?search='+query;
        if (page) {
            url_request += '&page='+page;
        }

        $.ajax({
            url: url_request,
            dataType: 'json',
            cache: false,
            success: function(data) {
                this.setState({
                    outputs: data.data,
                    current_page: data.current_page,
                    last_page: data.last_page
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
    <InvoicePanel url={location.href} />,
    document.getElementById('react')
);
