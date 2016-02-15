package com.example.olparc;

import java.util.ArrayList;
import java.util.List;
import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;
import android.annotation.SuppressLint;
import android.app.ProgressDialog;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.Toast;



public class Contact extends ActionBarActivity {
	private static String url_contact ="http://olparc.16mb.com/db_contact.php";
	ProgressDialog prodialog;
	JSONparser jsparser = new JSONparser();
	EditText inMessage;
	EditText inemail;
	private static final String TAG_SUCCESS = "success";
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_contactus);
		Button btnSend = (Button)findViewById(R.id.btn_send);
		inMessage = (EditText)findViewById(R.id.editTextMessage);
		inemail = (EditText)findViewById(R.id.editTextEmail);
		btnSend.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				new ContactUs().execute();
			}
		});
		
	}
	
	class ContactUs extends AsyncTask<String, String, String>{
		
		int success=0 ;
		
		@Override
	    protected void onPreExecute() {
	        super.onPreExecute();
	        prodialog = new ProgressDialog(Contact.this);
	        prodialog.setMessage("Sending feedback");
	        prodialog.setIndeterminate(false);
	        prodialog.setCancelable(true);
	        prodialog.show();
	    }
		
		
		protected String doInBackground(String... args) {
			// Converting Input data to String and intger to input to the database
			
			
			String body = inMessage.getText().toString();
			String email = inemail.getText().toString();
			
			List<NameValuePair> param = new ArrayList<NameValuePair>();
			param.add(new BasicNameValuePair("body", body));
			param.add(new BasicNameValuePair("sender", email));
			
			JSONObject json = jsparser.makeHttpRequest(url_contact, "POST", param);
			
			Log.d("Create Response", json.toString());
		
			 
            // check for success tag
            try {
                success = json.getInt(TAG_SUCCESS);
                
               
            } catch (JSONException e) {
                e.printStackTrace();
            }
			return null;
		}
		
		 protected void onPostExecute(String file_url) {
	            // dismiss the dialog once done
			
           	 prodialog.dismiss();
           	 if (success == 1) {
             	Toast.makeText(getApplicationContext(), "Feedback has beeen sent",Toast.LENGTH_LONG);
             } else {
                 // failed to create product
             	Toast.makeText(getApplicationContext(), "Error Occured",Toast.LENGTH_LONG);
             }
	         
	        }
	 
		
	}


}
