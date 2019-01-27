<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

       <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
            integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <div class="container" id="root">
            <div class="row">
                <div class="col-md-6 mx-auto">
                    <div class="card card-body text-center mt-5">
                        <h1 class="heading display-5 pb-3">Digital Risks</h1>

                        <form id="loan-form">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            First Name
                                        </div>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.customerName.firstName"
                                        id="firstName"
                                        placeholder="Please enter your first name"
                                    />
                                </div>
                            </div>

                              <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Last Name
                                        </div>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.customerName.lastName"
                                        id="lastName"
                                        placeholder="Please enter your last name"
                                    />
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text">
                                            Company No.
                                        </div>
                                    </div>
                                    <input
                                        type="text"
                                        class="form-control"
                                        v-model="input.companyNumber"
                                        id="companyNumber"
                                        placeholder="Please enter company number"
                                    />
                                </div>
                            </div>



                            <div class="form-group">
                                <input
                                    type="submit"
                                    v-on:click="getResults"
                                    class="btn btn-block btn-dark"
                                />
                            </div>
                        </form>

                        <div v-if="loading" id="loading">
                            <img src="img/loading.gif" alt="" />
                        </div>

                        <div v-if="showResults" id="results" class="pt-4">
                            <h5>Results</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <script src="js/app.js"></script>
    </body>
</html>
