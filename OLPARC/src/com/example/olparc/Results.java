package com.example.olparc;

import java.util.ArrayList;
import java.util.List;

import org.apache.http.NameValuePair;
import org.apache.http.cookie.SetCookie;
import org.apache.http.message.BasicNameValuePair;
import org.json.JSONArray;
import org.json.JSONException;
import org.json.JSONObject;

import com.example.olparc.OnlinePurchase.Details;

import android.app.AlertDialog;
import android.app.DialogFragment;
import android.app.ProgressDialog;
import android.content.Context;
import android.content.SharedPreferences;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.text.InputType;
import android.util.Log;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.AdapterView;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.AdapterView.OnItemSelectedListener;
import android.widget.LinearLayout.LayoutParams;
import android.widget.Toast;

public class Results extends ActionBarActivity{
	
	EditText [] number;
	EditText num1;
	ProgressDialog prodialog;  //progress dialog to indicate the waiting period or loading period
	JSONparser jparser = new JSONparser(); //creating an object from jsonparsen class to pass data to database
	String lotteryname="";
	LinearLayout number_layout,historyLayout;
	private static final String TAG_SUCCESS = "success";
	private static String url_lotteryDetails = "http://olparc.16mb.com/db_lotterydetails.php";
	private static String url_lotteryhistory= "http://olparc.16mb.com/result_history.php";
	private static String url_lotterynumbers = "http://olparc.16mb.com/results_db.php";
	Spinner lotterySpinner;
	LinearLayout.LayoutParams params;
	AlertDialog.Builder buider ;
	AlertDialog alert;
	LinearLayout pop;
	EditText drawno;
	Button addtochek;
	SharedPreferences prefs;
	int userId;
	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_results);
		
		lotterySpinner = (Spinner)findViewById(R.id.spinner_lottery)		;
		number_layout=(LinearLayout)findViewById(R.id.numbers_layout);
		historyLayout=(LinearLayout)findViewById(R.id.history_layout);
		num1=(EditText)findViewById(R.id.edit_field);
		drawno = (EditText)findViewById(R.id.editTextDrawno);
		params =(LayoutParams) num1.getLayoutParams();
		pop=new  LinearLayout(this);
		addtochek = (Button)findViewById(R.id.btn_check);
		
		 prefs = this.getSharedPreferences("com.example.olparc", Context.MODE_PRIVATE);
		userId = prefs.getInt("userId", 0);
		buider = new AlertDialog.Builder(this);
		
		buider.setView(pop);
		alert=buider.create();

		
		lotterySpinner.setOnItemSelectedListener(new OnItemSelectedListener() {
		    @Override
		    public void onItemSelected(AdapterView<?> parentView, View selectedItemView, int position, long id) {

				lotteryname =lotterySpinner.getSelectedItem().toString();
				
				new Lottery().execute();
		    }

		    @Override
		    public void onNothingSelected(AdapterView<?> parentView) {

				lotteryname =lotterySpinner.getSelectedItem().toString();
				
				new Lottery().execute();
		    }

		});
		
		addtochek.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				for(int i=0;i<number.length;i++)
					if(number[i].getText().toString().trim().length()==0){
						Toast.makeText(getApplicationContext(), "Enter all fields", Toast.LENGTH_LONG).show();;
						return;
					}
				String inputs="";
				
				for(int i=0;i<number.length;i++)
					inputs+=number[i].getText().toString()+" ";
				
				inputs=inputs.trim();
				
				Log.d("inputs",inputs);
				new LotteryDetails().execute(inputs);
				
				
			}
		});
	}
	
	class Lottery extends AsyncTask<String, String, String>{
		
		int success=0 ;
		 int letter ;
    	 int special;
    	 int sign;
    	 int numbers;
    	 int limit;
		@Override
	    protected void onPreExecute() {
	        super.onPreExecute();
	        prodialog = new ProgressDialog(Results.this);
	        prodialog.setMessage("Setting layout.");
	        prodialog.setIndeterminate(false);
	        prodialog.setCancelable(true);
	        prodialog.show();
	    }
		
		@Override
		protected String doInBackground(String... args) {
			// Converting Input data to String and intger to input to the database
			
			String lottery = lotteryname;
			
			
			
			List<NameValuePair> param = new ArrayList<NameValuePair>();
			param.add(new BasicNameValuePair("lotteryname", lottery));
			
			
			JSONObject json = jparser.makeHttpRequest(url_lotteryDetails, "GET", param);
			
			Log.d("Create Response", json.toString());
		
			 
            // check for success tag
            try {
                success = json.getInt(TAG_SUCCESS);
                
                if (success == 1) {
                	 letter = json.getInt("letter");
                	 special =json.getInt("specialnumber");
                	 sign =json.getInt("sign");
                	 numbers = json.getInt("numbers");
                	 limit = json.getInt("limit");
                                  // successfully created product
                	 
                	
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
			 
			 int noOfInputs=numbers+(letter==1?1:0)+(special==1?1:0);
			 int tracker=0;
			 number=new EditText[noOfInputs];

	           	number_layout.removeAllViews();
	         
	         if(letter==1){
       			 
        			 EditText temp = new EditText(Results.this);
        			 temp.setLayoutParams(params); 
        			temp.setInputType(InputType.TYPE_CLASS_TEXT);
   				temp.setHint("Letter");
   				
   				number_layout.addView(temp);
   				number[tracker++]=temp;
           	 }
           	 if(special==1){
           		 EditText temp = new EditText(Results.this);
        			 temp.setLayoutParams(params); 
        			 temp.setInputType(InputType.TYPE_CLASS_NUMBER);
        			 temp.setHint("Bonus");
        			 
        			 number_layout.addView(temp);
        				number[tracker++]=temp;
           	 }
           	 
           	 for(int i=0;i<numbers;i++){
           		 
           		 EditText temp = new EditText(Results.this);
           		 temp.setLayoutParams(params); 
        		 temp.setInputType(InputType.TYPE_CLASS_NUMBER);
   				 temp.setHint("Num "+(i+1));
   				
   				number_layout.addView(temp);
   				number[tracker++]=temp;
   				
           	 }
           	 prodialog.dismiss();

     		new Check().execute();
	         
	        }
	 
		
	}
class LotteryDetails extends AsyncTask<String, String, String>{
		
		 int success=0 ;
		
		@Override
	    protected void onPreExecute() {
	        super.onPreExecute();
	        prodialog = new ProgressDialog(Results.this);
	        prodialog.setMessage("Adding to check.");
	        prodialog.setIndeterminate(false);
	        prodialog.setCancelable(true);
	        prodialog.show();
	    }
		
		@Override
		protected String doInBackground(String... args) {
			// Converting Input data to String and intger to input to the database
			
			String lottery = lotteryname;
			String draw = drawno.getText().toString();
			String userid = String.valueOf(userId);
			
			List<NameValuePair> param = new ArrayList<NameValuePair>();
			param.add(new BasicNameValuePair("lotteryname", lottery));
			param.add(new BasicNameValuePair("draw", draw));
			param.add(new BasicNameValuePair("numbers", args[0]));
			param.add(new BasicNameValuePair("userId", userid));
			
			JSONObject json = jparser.makeHttpRequest(url_lotterynumbers, "POST", param);
			
			Log.d("Create Response", json.toString());
		
			 
            // check for success tag
            try {
                success = json.getInt(TAG_SUCCESS);
                
                if (success == 1) {
                	
                	//Toast.makeText(getApplicationContext(), "Successfuly added to the database", Toast.LENGTH_LONG).show();;
                                  // successfully created product
                	 
                	
                } else {
                    // failed to create product
                }
            } catch (JSONException e) {
                e.printStackTrace();
            }
			return null;
		}
		
		 protected void onPostExecute(String file_url) {
	        
           	 prodialog.dismiss();
           	 new Check().execute();
	        }
	 
		
	}
class Check extends AsyncTask<String, String, String>{
	
	 int success=0 ;
	 JSONObject json=null;
	
	@Override
   protected void onPreExecute() {
       super.onPreExecute();
       prodialog = new ProgressDialog(Results.this);
       prodialog.setMessage("Retrieve data");
       prodialog.setIndeterminate(false);
       prodialog.setCancelable(true);
       prodialog.show();
   }
	
	@Override
	protected String doInBackground(String... args) {
		// Converting Input data to String and intger to input to the database
		
		String userid = String.valueOf(userId);
		
		List<NameValuePair> param = new ArrayList<NameValuePair>();
		
		param.add(new BasicNameValuePair("userId", userid));
		
		json = jparser.makeHttpRequest(url_lotteryhistory, "GET", param);
		
		Log.d("Create Response", json.toString());
	
		 
       // check for success tag
       try {
           success = json.getInt(TAG_SUCCESS);
           Log.d("suc",""+success);
           
           if (success == 1) {
           	
           	 
           	
           } else {
               // failed to create product
           }
       } catch (JSONException e) {
           e.printStackTrace();
       }
		return null;
	}
	
	 protected void onPostExecute(String file_url) {
       
      	 historyLayout.removeAllViews();
      	if (success == 1) {
      		Log.d("NUMB","dddddff");
          	 try {
          		JSONArray jsonMainArr = json.getJSONArray("data");
          		
          		Log.d("data", jsonMainArr.toString());
          		
          		for (int i = 0; i < jsonMainArr.length(); i++) {  // **line 2**
          		     JSONObject childJSONObject = jsonMainArr.getJSONObject(i);
          		     String numbers = childJSONObject.getString("numbers");
          		     String winning = childJSONObject.getString("wining");
          		     int id     = childJSONObject.getInt("lotteryId");
          		     Log.d("NUMB",""+numbers);
          		   TextView temp=new TextView(Results.this);
       			temp.setText(id+" "+numbers+" "+winning);
       			historyLayout.addView(temp);
          		}
			} catch (JSONException e) {
				// TODO Auto-generated catch block
				Log.d("NUMB","catch");
				e.printStackTrace();
			}
          	
			prodialog.dismiss();
        } else {
        	Log.d("NUMB","fffff");
            // failed to create product
        }
        
       }

	
}


}
