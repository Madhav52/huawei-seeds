<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    hr.contactus-divider {
    border-top: 8px solid #033691;
}
</style>

<body>
    <section>
        <div class="user-details text-left">
            <div class="user-details-wrapper">
                <h1 style="font-size: 40px">{{$user->name}}</h1>
            <hr
                class="mx-3 mb-0 contactus-divider"
                style="width: 100%; margin-top: 1.5rem"
              />
              <div class="user-personal-details">
                  <h1 style="font-size: 30px; margin-bottom: 0">Personal Details</h1>
                  <hr
                class="mx-3 mb-0 contactus-divider"
                style="width: 300px; margin-top: 0.5rem; margin-left: 0"
              />
                  <h1 style="font-size: 25px; margin-bottom: 0">Address</h1>
                  <h1 style="font-size: 20px; margin: 0">{{$user->userdetail->address}}</h1>
                  <h1 style="font-size: 25px; margin-bottom: 0">Phone</h1>
                  <h1 style="font-size: 20px; margin: 0">{{$user->userdetail->phone}}</h1>
                  <h1 style="font-size: 25px; margin-bottom: 0">Email</h1>
                  <h1 style="font-size: 20px; margin: 0">{{$user->userdetail->email}}</h1>
                  <h1 style="font-size: 25px; margin-bottom: 0">Gender</h1>
                  <h1 style="font-size: 20px; margin: 0">{{$user->userdetail->gender}}</h1>
                  <h1 style="font-size: 30px; margin-bottom: 0">Education Details</h1>
                  <hr
                        class="mx-3 mb-0 contactus-divider"
                        style="width: 300px; margin-top: 0.5rem; margin-left: 0"
                    />
                  <h1 style="font-size: 25px; margin-bottom: 0">Institution</h1>
                  <h1 style="font-size: 20px; margin: 0">{{$user->userdetail->institution}}</h1>
                  <h1 style="font-size: 25px; margin-bottom: 0">University</h1>
                  <h1 style="font-size: 20px; margin: 0">{{$user->userdetail->university}}</h1>
                  <h1 style="font-size: 30px; margin-bottom: 0">Personal Statement</h1>
                  <hr
                        class="mx-3 mb-0 contactus-divider"
                        style="width: 350px; margin-top: 0.5rem; margin-left: 0"
                    />
                  <h1 style="font-size: 20px; margin: 0">{{$user->userdetail->statement}}</h1>
              </div>
            </div>
        </div>
    </section>
</body>

</html>