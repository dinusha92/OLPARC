package com.example.olparc;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import android.support.v7.app.ActionBarActivity;
import android.support.v7.app.ActionBar;
import android.support.v4.app.Fragment;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.Menu;
import android.view.MenuItem;
import android.view.View;
import android.view.View.OnClickListener;
import android.view.ViewGroup;
import android.webkit.WebView.FindListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;
import android.os.Build;

public class MainActivity extends ActionBarActivity {

	EditText input_username;
	EditText input_password;;
	TextView sign_up;;
	int userId=11;
	 SharedPreferences prefs;
	ProgressDialog prodialog;  //progress dialog to indicate the waiting period or loading period
	JSONparser jsparser = new JSONparser(); //creating an object from jsonparsen class to pass data to database
	
	
	
	private static final String TAG_SUCCESS = "success";
	
	private static String url_signIn ="http://olparc.16mb.com/db_login.php";
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.fragment_main);
        
      
       prefs = this.getSharedPreferences("com.example.olparc", Context.MODE_PRIVATE);
        input_username = (EditText)findViewById(R.id.editTextUsername);
        input_password = (EditText) findViewById(R.id.editTextPassword);
        
       
        //prefs.getInt("userId", 11);
        Button btnSignIn = (Button)findViewById(R.id.buttonSignIn);
        sign_up=(TextView)findViewById(R.id.textView_sign);
        
        btnSignIn.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				new SignIn().execute();
				
			}
		});
        
        sign_up.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent register= new Intent(MainActivity.this,RegisterActivity.class);
				startActivity(register);
			}
		});
        Button test = (Button)findViewById(R.id.btn_test);
        test.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent profile = new Intent(MainActivity.this, profilemainpage.class);
				startActivity(profile);
			}
		});
        
    }
    
    /* Contains the code part for the sign in process in the following class*/
	class SignIn extends AsyncTask<String, String, String>{

		@Override
	    protected void onPreExecute() {
	        super.onPreExecute();
	        prodialog = new ProgressDialog(MainActivity.this);
	        prodialog.setMessage("Signing In..");
	        prodialog.setIndeterminate(false);
	        prodialog.setCancelable(true);
	        prodialog.show();
	    }
		@Override
		protected String doInBackground(String... args) {
			// Converting Input data to String and integer to input to the database
			String username = input_username.getText().toString();
			String password = input_password.getText().toString();
			
			
			List<NameValuePair> param = new ArrayList<NameValuePair>();
			
			param.add(new BasicNameValuePair("username", username));
			param.add(new BasicNameValuePair("password", password));
			
			JSONObject json = jsparser.makeHttpRequest(url_signIn, "GET", param);
			
			Log.d("Create Response", json.toString());
			 
            // check for success tag
            try {
                int success = json.getInt(TAG_SUCCESS);
 
                if (success == 1) {
                    // successfully created product
                	prefs.edit().putInt("userId", json.getInt("userId")).commit();
                	Log.d("userId", ""+json.getInt("userId"));
                  	Intent i = new Intent(getApplicationContext(),profilemainpage.class);
                  	
                    startActivity(i);
                    // closing this screen
                    finish();
                } else {
                    // failed to create product
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
			return null;
		}
		
		 protected void onPostExecute(String file_url) {
	            // dismiss the dialog once done
	            prodialog.dismiss();
	            
	        }
	 
		
	}
	/*----End of Signing In data retreaval----*/

    @Override
    public boolean onCreateOptionsMenu(Menu menu) {
        
        // Inflate the menu; this adds items to the action bar if it is present.
        getMenuInflater().inflate(R.menu.main, menu);
        return true;
    }

    @Override
    public boolean onOptionsItemSelected(MenuItem item) {
        // Handle action bar item clicks here. The action bar will
        // automatically handle clicks on the Home/Up button, so long
        // as you specify a parent activity in AndroidManifest.xml.
        int id = item.getItemId();
        if (id == R.id.action_settings) {
            return true;
        }
        return super.onOptionsItemSelected(item);
    }

    /**
     * A placeholder fragment containing a simple view.
     */


}
