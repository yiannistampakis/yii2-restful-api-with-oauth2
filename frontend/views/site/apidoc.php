<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
$this->title = 'API 1.0 Documenation';
$this->params['breadcrumbs'][] = $this->title;
$protocol="http";
//$api_host="yii2-rest- < front || back >:8080";
$api_host="yii2-rest-back:8080";

?>

<div>
    <h1 style="color:#1b809e;">HRM REST API (v.<?= Yii::$app->params['API_VERSION'] ?>) </h1>

    <p>The REST API lets you interact with the HRM App from anything that can send an HTTP request. </p>
    <!-- <ul>
        <li>A mobile app can access App data.</li>
        <li>A webserver can show data from this App on a website.</li>
        <li>Applications written in any programming language can interact with data on this App.</li>
    </ul> -->
    <h3 style="color:#1b809e;">Quick Reference</h3>

    <p>
        All API access is over <b><?= strtoupper($protocol); ?></b>, and accessed via the
        <mark><?php echo $protocol . "://" . $api_host; ?></mark>
        domain.The relative path prefix <code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/</code> indicates that we are
        currently using <code>version <?= Yii::$app->params['API_VERSION'] ?></code> of the API.
    </p>
</div>

<h4 style="color:#1b809e;">Register/Signup</h4>
<div class="table-responsive">
    <table class="table">
        <tr class="info ">
            <th class="col-md-3">URL</th>
            <th class="col-md-2">HTTP Verb</th>
            <th class="col-md-4">Functionality</th>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/register</code></td>
            <td><strong>POST</strong></td>
            <td><a href="#register">Signup a user</a></td>
        </tr>
    </table>
</div>

<h4 style="color:#1b809e;">OAuth2.0</h4>
<div class="table-responsive">
    <table class="table col-md-9">
        <tr class="info">
            <th class="col-md-3">URL</th>
            <th class="col-md-2">HTTP Verb</th>
            <th class="col-md-4">Functionality</th>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/authorize</code></td>
            <td><strong>POST</strong></td>
            <td><a href="#authorizing_user">Authorizing User account</a></td>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/accesstoken</code></td>
            <td><strong>POST</strong></td>
            <td><a href="#obtain_access_token">Obtain Access token</a></td>
        </tr>
    </table>
</div>

<h4 style="color:#1b809e;">User</h4>
<div class="table-responsive">
    <table class="table">
        <tr class="info ">
            <th class="col-md-3">URL</th>
            <th class="col-md-2">HTTP Verb</th>
            <th class="col-md-4">Functionality</th>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/me</code></td>
            <td><strong>GET</strong></td>
            <td><a href="#me">Get User info.</a></td>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/logout</code></td>
            <td><strong>GET</strong></td>
            <td><a href="#logout">Logout User</a></td>
        </tr>
    </table>
</div>
<h4 style="color:#1b809e;"> Persons</h4>
<div class="table-responsive">
    <table class="table">
        <tr class="info ">
            <th class="col-md-3">URL</th>
            <th class="col-md-2">HTTP Verb</th>
            <th class="col-md-4">Functionality</th>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person</code></td>
            <td><strong>GET</strong></td>
            <td><a href="#list_employees">List Persons</a></td>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/create</code></td>
            <td><strong>POST</strong></td>
            <td><a href="#create_employee">Create a new Person</a></td>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/update/&ltid&gt</code></td>
            <td><strong>PUT</strong></td>
            <td><a href="#update_employee">Update a Person record</a></td>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/view/&ltid&gt</code></td>
            <td><strong>GET</strong></td>
            <td><a href="#view_employee">View a Person record</a></td>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/delete/&ltid&gt</code></td>
            <td><strong>DELETE</strong></td>
            <td><a href="#delete_employee">Delete a Person record</a></td>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/sdap</code></td>
            <td><strong>GET</strong></td>
            <td><a href="#person_employee">Get all active Persons (as Employees) with their latest Department placement</a></td>
        </tr>
        <tr>
            <td><code>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/sdap/teacher</code></td>
            <td><strong>GET</strong></td>
            <td><a href="#person_teacher">Get all Persons (as Teachers)</a></td>
        </tr>
    </table>
</div>

<div id="request_format">
    <h4 style="color:#1b809e;">Request format</h4>

    <p>For all POST/PUT requests the request body must contain a json body.

    </p>
    <pre>
        eg:
           {
             "username":"user123",
             "password":"password here"
           }
    </pre>
</div>
<div id="response_format">
    <h4 style="color:#1b809e;">Response format</h4>

    <p>The Response format for all the request is a JSON object.
        Whether a request succeeded is indicated by the HTTP status code.
        A 2xx status code indicates success, whereas a 4xx status code indicates failure.
        When a request fails, the response body is still JSON, but always contains the fields code and error which you
        can inspect to use for debugging.
        For example,
    </p>
    <h5 style="color:#1b809e;">Success Response format</h5>
    <pre>
      {
        "status": 1,
        "data": {
            "authorization_code": "191446c4d52b7d1e5878a947443cc928",
            "expires_at": 1430429516
        }
      }
    </pre>
    <h5 style="color:#1b809e;">Failed Response format</h5>
    <pre>
      {
        "status": 0,
        "error_code": 400,
        "errors": {
            "password": [
                "Incorrect username or password."
            ]
        }
     }
    </pre>
</div>
<div id="register">
    <h4 style="color:#1b809e;">Register/Signup a user</h4>

    <p>
        To Register/SignUp a new user account.
    </p>
    <h6>Request</h6>
      <pre>
      curl -X POST \
      <?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/register \
      -H 'content-type: application/json' \
      -d '{
      "username":"user123",
      "password":"pass123",
      "email":"user123@gmail.com"
    }'

    </pre>
    <h6>Success Response</h6>
    <pre>
      {
    "status": 1,
    "data": {
        "id": 5,
        "username": "user123",
        "email": "user123@gmail.com",
        "status": 10,
        "created_at": 1505615167,
        "updated_at": 1505615167
    }
}
        </pre>
</div>
<div id="authorizing_user">
    <h4 style="color:#1b809e;">Authorizing User account</h4>

    <p>
        To authorize a user account using their username & password. Send a POST
        request to the URL with the user informations then it will return an <b>Authorization
            token</b> which can be used to obtain an <b>access-token</b> for further API calls.
    </p>
    <pre>
    curl -X POST \
        <?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/authorize \
      -H 'content-type: application/json' \
      -d '{
      "username":"user123",
      "password":"pass123"
    }'
    </pre>
    <p>
        When the Authorization is successful, the HTTP response will be 200 OK with
        a JSON object containing a status element having a success value 1.

    <p>
    <pre>

        {
            "status": 1,
            "data": {
                "authorization_code": "eb9155aaea82d968046b01d3b9ae075f",
                "expires_at": 1430427799
                    }
        }

        </pre>

</div>
<div id="obtain_access_token">
    <h4 style="color:#1b809e;">Get Access token</h4>

    <p>
        To Obtain a new Acces token. Send a POST request with a parameter <b>authorization_code</b> obtained
        from the <code>/authorize</code> action.
    </p>
    <h6>Request</h6>
      <pre>
      curl -X POST \
          <?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/accesstoken \
      -H 'content-type: application/json' \
      -d '{
            "authorization_code": "eb9155aaea82d968046b01d3b9ae075f"
         }'


    </pre>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": {
                "access_token": "74191f2b7fb6da7e60be2d5bee345a8b",
                "expires_at": 1435665158
            }
        }
        </pre>
</div>
<div id="me">
    <h4 style="color:#1b809e;">Get User Info.</h4>

    <p>
        To get the User informations.
    </p>
    <h6>Request</h6>
      <pre>
      curl -X GET \
     -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b" \
     -G  '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/me'

    </pre>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": {
                "id": 5,
                "username": "user123",
                "email": "user123@gmail.com",
                "status": 10,
                "created_at": 1505615167,
                "updated_at": 1505615167
            }
        }
        </pre>
</div>

<div id="logout">
    <h4 style="color:#1b809e;">LogOut a user account</h4>

    <p>
        To LogOut a user account.

    </p>
    <h6>Request</h6>
      <pre>
    curl -X GET \
          -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b" \
          -G  '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/logout'


    </pre>
    <h6>Success Response</h6>
    <pre>
        {
          "status": 1,
          "data": [ "Logged Out Successfully" ]
        }
        </pre>
</div>
<div id="list_employees">
    <h4 style="color:#1b809e;">List Persons</h4>

    <p>
        To List all persons.

    </p>
    <h6>Request</h6>
      <pre>
    curl -X GET \
          -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b" \
          -G  '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person'


    </pre>
    <code> Optional sort/filter params: page, limit, order, search[PER_AFM], search[PER_Id], search[PER_LastName]... etc</code>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": [
                {
                    "PER_Id": 1,
                    "PER_FirstName": "ΓΙΑΝΝΗΣ",
                    "PER_LastName": "ΠΑΠΑΔΟΠΟΥΛΟΣ",
                    "PER_FatherFirstName": "ΧΡΗΣΤΟΣ",
                    "PER_AFM": "111111111111"
                    "PER_Email": "test1@test.com" 
                },
                {
                    "PER_Id": 2,
                    "PER_FirstName": "ΓΙΩΡΓΟΣ",
                    "PER_LastName": "ΔΗΜΗΤΡΙΟΥ",
                    "PER_FatherFirstName": "ΑΝΤΩΝΗΣ",
                    "PER_AFM": "222222222222"
                    "PER_Email": "test2@test.com" 
                }
            ],
            "page": 1,
            "size": 10000,
            "totalCount": 2
        }
        </pre>
</div>
<div id="create_employee">
    <h4 style="color:#1b809e;">Create a new Person</h4>

    <p>
        To Create a new Person record.
    </p>
    <h6>Request</h6>
      <pre>
    curl -X POST \
          '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/create' \
          -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b" \
          -H 'content-type: application/json' \
          -d '{
                    "PER_FirstName": "ΜΑΡΙΑ",
                    "PER_LastName": "ΧΑΡΙΤΟΥ",
                    "PER_FatherFirstName": "ΠΑΝΑΓΙΩΤΗΣ",
                    "PER_AFM": "333333333333"
                    "PER_Email": "test3@test.com" 
                }'


    </pre>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": {
                "PER_Id": 3,
                "PER_FirstName": "ΜΑΡΙΑ",
                "PER_LastName": "ΧΑΡΙΤΟΥ",
                "PER_FatherFirstName": "ΠΑΝΑΓΙΩΤΗΣ",
                "PER_AFM": "333333333333",
                "PER_Email": "test3@test.com"
            }
        }
        </pre>
</div>
<div id="update_employee">
    <h4 style="color:#1b809e;">Update a Person record</h4>

    <p>
        To Update Person record.
    </p>
    <h6>Request</h6>
      <pre>
    curl -X PUT \
          '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/update/3' \
          -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b" \
          -H 'content-type: application/json' \
          -d '{
                  "PER_FirstName":"ΜΑΡΙΑΝΘΗ"
            }'

    </pre>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": {
                "PER_Id": 3,
                "PER_FirstName": "ΜΑΡΙΑΝΘΗ",
                "PER_LastName": "ΧΑΡΙΤΟΥ",
                "PER_FatherFirstName": "ΠΑΝΑΓΙΩΤΗΣ",
                "PER_AFM": "333333333333",
                "PER_Email": "test3@test.com"
            }
        }
        </pre>
</div>
<div id="view_employee">
    <h4 style="color:#1b809e;">View a person's details</h4>

    <p>
        To view a person's record.
    </p>
    <h6>Request</h6>
      <pre>
     curl -X GET \
          '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/view/3' \
          -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b"

    </pre>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": {
                "PER_Id": 3,
                "PER_FirstName": "ΜΑΡΙΑΝΘΗ",
                "PER_LastName": "ΧΑΡΙΤΟΥ",
                "PER_FatherFirstName": "ΠΑΝΑΓΙΩΤΗΣ",
                "PER_AFM": "333333333333",
                "PER_Email": "test3@test.com"
            }
        }
        </pre>
</div>
<div id="delete_employee">
    <h4 style="color:#1b809e;">Delete a person's record</h4>

    <p>
        To Delete a person's record.<br/>
    </p>
    <h6>Request</h6>
      <pre>
   curl -X DELETE \
          '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/delete/3' \
          -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b"
    </pre>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": {
                "PER_Id": 3,
                "PER_FirstName": "ΜΑΡΙΑΝΘΗ",
                "PER_LastName": "ΧΑΡΙΤΟΥ",
                "PER_FatherFirstName": "ΠΑΝΑΓΙΩΤΗΣ",
                "PER_AFM": "333333333333",
                "PER_Email": "test3@test.com"
            }
        }
        </pre>

</div>

<div id="person_employee">
    <h4 style="color:#1b809e;">Get all active Persons (as Employees) with their latest Department placement</h4>

    <p>
        To get all active Employees with their latest Department placement. The AFM value must be already set.<br/>
    </p>
    <h6>Request</h6>
      <pre>
   curl -X GET \
          '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/sdap' \
          -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b"
    </pre>
    <code> Optional sort/filter params: page, limit, order, search[PER_AFM], search[PER_Id], search[PER_LastName]... etc</code>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": [
                {
                    "PER_Id": 3,
                    "PER_FirstName": "ΜΑΡΙΑΝΘΗ",
                    "PER_LastName": "ΧΑΡΙΤΟΥ",
                    "PER_FatherFirstName": "ΠΑΝΑΓΙΩΤΗΣ",
                    "PER_AFM": "333333333333",
                    "PER_Email": "test3@test.com"
                    "PLH_DEP_Id": 123
                },
                {
                    ...
                },
                ...
            ]
        }
        </pre>

</div>

<div id="person_teacher">
    <h4 style="color:#1b809e;">Get all Persons (as Teachers)</h4>

    <p>
        To get all Teachers. The AFM value must be already set.<br/>
    </p>
    <h6>Request</h6>
      <pre>
   curl -X GET \
          '<?php echo $protocol . "://" . $api_host; ?>/<?= Yii::$app->params['API_VERSION_URL'] ?>/person/sdap/teacher' \
          -H "X-Access-Token: 74191f2b7fb6da7e60be2d5bee345a8b"
    </pre>
    <code> Optional sort/filter params: page, limit, order, search[PER_AFM], search[PER_Id], search[PER_LastName]... etc</code>
    <h6>Success Response</h6>
    <pre>
        {
            "status": 1,
            "data": [
                {
                    "PER_Id": 3,
                    "PER_FirstName": "ΜΑΡΙΑΝΘΗ",
                    "PER_LastName": "ΧΑΡΙΤΟΥ",
                    "PER_FatherFirstName": "ΠΑΝΑΓΙΩΤΗΣ",
                    "PER_AFM": "333333333333",
                    "PER_Email": "test3@test.com"
                },
                {
                    ...
                },
                ...
            ]
        }
        </pre>

</div>
