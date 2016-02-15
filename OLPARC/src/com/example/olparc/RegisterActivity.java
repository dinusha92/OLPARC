package com.example.olparc;

import android.app.Activity;
import android.os.Bundle;

import java.util.ArrayList;
import java.util.List;
 












import org.apache.http.NameValuePair;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONException;
import org.json.JSONObject;

import android.app.AlertDialog;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.text.InputType;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
 
public class RegisterActivity extends Activity{

	AlertDialog alertDialog;
	ProgressDialog prodialog;  //progress dialog to indicate the waiting period or loading period
	JSONparser jparser = new JSONparser(); //creating an object from jsonparsen class to pass data to database
	
	private static final String TAG_SUCCESS = "success";
	//To get the inputs from the register process edittext fields are initalized
	EditText infirst = null;
	EditText insecond = null;
	EditText inemail = null;
	EditText inmobile = null;
	EditText inaddress = null;
	EditText inusername = null;
	EditText inpassword = null;
		
	private static String url_registerUser = "http://olparc.16mb.com/db_register.php";
	final Context context = this;
	private Button button;
	private EditText result;

	int code =1564253;

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_register);
       
        Button btnReg =(Button)findViewById(R.id.btn_register);
        infirst = (EditText)findViewById(R.id.editText_first);
        insecond = (EditText)findViewById(R.id.editText_second);
        inemail = (EditText)findViewById(R.id.editText_email);
        inmobile = (EditText)findViewById(R.id.editText_number);
        inaddress = (EditText)findViewById(R.id.editText_address);
        inusername = (EditText)findViewById(R.id.editText_username);
        inpassword = (EditText)findViewById(R.id.editText_password);
        
        setupAlertBox();
        
        btnReg.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				new Register().execute();

			}
		});
	}
	class Register extends AsyncTask<String, String, String>{
		
		int success=0 ;
		
		@Override
	    protected void onPreExecute() {
	        super.onPreExecute();
	        prodialog = new ProgressDialog(RegisterActivity.this);
	        prodialog.setMessage("Registering New User..");
	        prodialog.setIndeterminate(false);
	        prodialog.setCancelable(true);
	        prodialog.show();
	    }
		
		@Override
		protected String doInBackground(String... args) {
			// Converting Input data to String and intger to input to the database
			String first = infirst.getText().toString();
			String second = insecond.getText().toString();
			String email =  inemail.getText().toString();
			int mobile = Integer.parseInt(inmobile.getText().toString());
			String address = inaddress.getText().toString();
			String username = inusername.getText().toString();
			String password = inpassword.getText().toString();
			
			
			List<NameValuePair> param = new ArrayList<NameValuePair>();
			param.add(new BasicNameValuePair("first", first));
			param.add(new BasicNameValuePair("second", second));
			param.add(new BasicNameValuePair("email", email));
			param.add(new BasicNameValuePair("address",address));
			param.add(new BasicNameValuePair("mobile",Integer.toString(mobile)));
			param.add(new BasicNameValuePair("username", username));
			param.add(new BasicNameValuePair("password", password));
			
			JSONObject json = jparser.makeHttpRequest(url_registerUser, "POST", param);
			
			Log.d("Create Response", json.toString());
			 
            // check for success tag
            try {
                success = json.getInt(TAG_SUCCESS);
                
                if (success == 1) {
                	
                code =(Integer) json.get("code");
                
                    // successfully created product
                

            		//alertDialog.show();
                	
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
	            if (success == 1) {
                	
	                //int code =(Integer) json.get("code");
	                    // successfully created product
	                

	            		alertDialog.show();
	                	
	                }
	        }
	 
		
	}
	
	
	void setupAlertBox(){
		LayoutInflater li = LayoutInflater.from(context);
		final View promptsView = li.inflate(R.layout.prompt, null);
		AlertDialog.Builder alertDialogBuilder = new AlertDialog.Builder(
				context);

		// set prompts.xml to alertdialog builder
		alertDialogBuilder.setView(promptsView);

		final EditText userInput = (EditText) promptsView
				.findViewById(R.id.editTextCode);
		
		final TextView textV=(TextView) promptsView
				.findViewById(R.id.textViewCode);
		
		userInput.setVisibility(View.VISIBLE);
		userInput.setInputType(InputType.TYPE_CLASS_NUMBER);
		textV.setText("Type Your Message : ");
		
		alertDialogBuilder
		.setCancelable(false)
		.setPositiveButton("OK",
		  new DialogInterface.OnClickListener() {
		    public void onClick(DialogInterface dialog,int id) {
			// get user input and set it to result
			// edit text
		    	
		    	if(code==Integer.parseInt(userInput.getText()+"")){	    	 
		    	Intent i = new Intent(getApplicationContext(), profilemainpage.class);
                startActivity(i);

                // closing this screen
                finish();
		    	}
		    	else{
		    		userInput.setVisibility(View.GONE);
		    		textV.setText("Entered code is incorrect");
		    	}
			
      		 
      	
		    }
		  })
		.setNegativeButton("Cancel",
		  new DialogInterface.OnClickListener() {
		    public void onClick(DialogInterface dialog,int id) {
			dialog.cancel();
		    }
		  });

	// create alert dialog
	alertDialog = alertDialogBuilder.create();

	// show it
		
	
	}
	
}

