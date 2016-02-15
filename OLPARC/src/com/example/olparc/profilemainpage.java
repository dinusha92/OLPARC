package com.example.olparc;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.ActionBarActivity;
import android.view.View;
import android.view.View.OnClickListener;
import android.widget.Button;

public class profilemainpage extends ActionBarActivity {

	@Override
	protected void onCreate(Bundle savedInstanceState) {
		// TODO Auto-generated method stub
		super.onCreate(savedInstanceState);
		setContentView(R.layout.activity_profilemainpage);
		
		Button btnabout =(Button)findViewById(R.id.btn_about);
		Button btnpurchase =(Button)findViewById(R.id.btn_purchase); 
		Button btnresults =(Button)findViewById(R.id.btn_results); 
		Button btncontact =(Button)findViewById(R.id.btn_contact);
		
		btnabout.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent about =  new Intent(profilemainpage.this,About.class);
				startActivity(about);
			}
		});
		btnpurchase.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent purchase =  new Intent(profilemainpage.this,OnlinePurchase.class);
				startActivity(purchase);
			}
		});
		btnresults.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent results =  new Intent(profilemainpage.this,Results.class);
				startActivity(results);
			}
		});
		btncontact.setOnClickListener(new OnClickListener() {
			
			@Override
			public void onClick(View v) {
				// TODO Auto-generated method stub
				Intent contact =  new Intent(profilemainpage.this,Contact.class);
				startActivity(contact);
			}
		});
	}
	
}
