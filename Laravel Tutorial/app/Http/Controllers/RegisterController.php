<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\Student;
use Illuminate\Support\Facades\DB;

// use Hash;
// use Illuminate\Contracts\Session\Session;
// use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{
    //LOAD THE LOGIN PAGE
    public function login()
    {
        return view("loginuser");

    }

    //AFTER ENTERING LOGIN DETAILS CHECK
    public function postlogin(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $email = $request->email;
        $password = $request->password;
        if (Auth::attempt($credentials)) {
            $student = Student::where('email', $email)->first();
            if (Hash::check($password, $student->password)) {
                session()->put('user_id', $student->id);
                return redirect()->intended('/showusers')->withSuccess('Signed in');
            }
            return redirect("/loginuser")->with('completed', 'Login details are not valid');

        }
    }
    //Update THE USER DATA
    public function update(Request $request, $id)
    {
        $storeData = $request->validate([
            'first-name' => 'required|min:3',
            'last-name' => 'required|max:20',
            'email' => 'required|max:55|email',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|confirmed|min:8',
            'gender' => 'required|max:6'
        ]);
        $first_name = $request->input('first-name');
        $last_name = $request->input('last-name');
        $email = $request->input('email');
        $password = bcrypt($request->input('password'));
        $gender = $request->input('gender');
        $phone = $request->input('phone');

        $result = Student::where('id', $id)
            ->update(['first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'gender' => $gender, 'phone' => $phone, 'password' => $password]);
        if ($result) {
            return redirect('/showusers')->with('Completed', 'Successfully Updated!');
        } else
            return redirect('/showusers')->with('Failed', 'Not Updated!');
    }

    //LOAD THE UPDATE DATA PAGE BASED ON ID
    public function edit($id)
    {
        $user = Student::find($id);
        return view('updatedata', array('user' => $user));
    }

    //DELETE THE DATA OF USER FROM DB
    public function delete($id)
    {
        $user = Student::find($id);
        $user->delete();
        return redirect('/showusers')->with('Completed', 'Successfully Deleted!');
    }

    //register new user page
    public function registration()
    {
        return view('Newuser');
    }


    //STORE THE DATA OF USER INTO DB
    public function store(Request $request)
    {
        $storeData = $request->validate([
            'first_name' => 'required|min:3',
            'last_name' => 'required|max:20',
            'email' => 'required|max:55|email',
            'phone' => 'required|numeric|digits:10',
            'password' => 'required|confirmed|min:8',
            'gender' => 'required|max:6'
        ]);

        $email = $request->input('$email');
        if (Student::where('email', '=', $email)->count() > 0) {
            return redirect('registration')->with('status', 'Email Already Exists');
        } else {
            $data = $request->all();
            session($data);
            return to_route('verifyotp', ['number' => $data['phone']]);
        }
    }

    public function otpverification($number)
    {
        if (session()->has('first_name')) {
            return view('Otpverify', ['number' => $number]);
        } else {
            return redirect('registration')->with('status', 'Session Ended try Again');
        }
    }

    public function register()
    {
        $data = session()->all();
        print_r($data);

        if (isset($data['email']) && isset($data['password'])) {
            $check = $this->create($data);
            if ($check) {
                $credentials = [
                    'email' => $data['email'],
                    'password' => $data['password']
                ];
                if (Auth::attempt($credentials)) {
                    return redirect()->intended('/showusers')->withSuccess('Signed in');
                }
            } else {
                return redirect('registration')->with('status', 'QUERY FAILED');
            }
        } else {
            return redirect('registration')->with('status', 'Email and password not found in session');
        }
    }
    //CREATE AN ARRAY AND INSERT INTO DB
    public function create(array $data)
    {
        return Student::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'password' => bcrypt($data['password']),
            'gender' => $data['gender']
        ]);
    }

    //show all data of users
    public function showall()
    {
        $student = Student::all();
        return view("registeredusers", compact("student"));
    }

    //logout and clear authentication
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect('/')->with('Exit', 'LOGGED OUT!');
    }

    public function studentcourse(Request $request)
    {
        $data = $request->validate([
            'course' => 'required|min:3',
            'section' => 'required|max:2',
            'fees' => 'required|min:3',
        ]);
        DB::table('course')->insert([
            'coursename' => $data['course'],
            'section' => $data['section'],
            'fees' => $data['fees']
        ]);
    }

    public function courseupdate(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
            'course' => 'required',
            'section' => 'required',
        ]);
        $check = DB::table('course')->where('id', $data['id'])->update([
            'coursename' => $data['course'],
            'section' => $data['section'],
        ]);
        if ($check) {
            echo "updated";
        }
    }

    public function coursedelete(Request $request)
    {
        $data = $request->validate([
            'id' => 'required',
        ]);
        $check = DB::table('course')->where('id', '=', $data['id'])->delete();
        if ($check) {
            echo "deleted";
        }
    }

    public function joindata(Request $request)
    {
        $data = $request->validate([
            "id" => "required",
        ]);

        $users = DB::table('course')
            ->rightJoin('sections', 'course.id', '=', 'sections.id')
            ->get();

        echo "<table border='1'>";
        echo "<tr><th>Course ID</th><th>Course Name</th><th>Section ID</th><th>Strength</th></tr>";
        foreach ($users as $user) {
            echo "<tr>";
            echo "<td>" . $user->id . "</td>";
            echo "<td>" . $user->coursename . "</td>";
            echo "<td>" . $user->section_name . "</td>";
            echo "<td>" . $user->strength . "</td>";
            echo "</tr>";
        }
        echo "</table>";

    }

    public function uploadtoken(Request $request)
    {
        $check = DB::table('students')->where('id', session()->get('user_id'))->update([
            'device_token' => $request->notify_token,
        ]);
        if ($check) {
            return response()->json(['message' => 'Token successfully stored']);
        }
    }

    public function sendnotification(Request $request)
    {
        $accessToken = $this->getAccessToken();
        if (!$accessToken) {
            die('Failed to obtain access token');
        }
        $fcmtoken = Student::whereNotNull('device_token')->pluck('device_token')->all();
        $image = 'https://developercodez.com/public/ckfinder/userfiles/files/image-20230615002957-3.png';
        $url = 'https://fcm.googleapis.com/v1/projects/laravelpushnotification-78b76/messages:send';

        foreach ($fcmtoken as $token) {
            // Construct the notification payload with action buttons
            $data = [
                "message" => [
                    "token" => $token,
                    "webpush" => [
                        "notification" => [
                            "title" => $request->title,
                            "body" => $request->body,
                            "image" => $image,
                            "actions" => [
                                [
                                    "action" => "open_url",
                                    "title" => "Open Website",
                                ]
                                ],
                            "data" => [
                                    "url" => "https://youtube.com"
                                ]
                        ],
                    ]
                ]
            ];

            $notify_data = json_encode($data);
            $headers = [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json',
            ];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_1_1);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $notify_data);
            $result = curl_exec($ch);

            if ($result === false) {
                die('curl failed' . curl_error($ch));
            } else {
                // return view('welcome');
            }

            curl_close($ch);
        }
        // return redirect('/showusers');

    }
    private function getAccessToken()
    {
        $serviceAccountFile = public_path('service-account.json');
        $serviceAccountJson = json_decode(file_get_contents($serviceAccountFile), true);
        $client = new \Google_Client();
        $client->setAuthConfig($serviceAccountJson);
        $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
        // Get access token
        $accessToken = $client->fetchAccessTokenWithAssertion();
        if (isset($accessToken['access_token'])) {
            return $accessToken['access_token'];
        } else {
            return null;
        }
    }
}