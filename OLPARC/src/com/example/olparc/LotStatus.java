package com.example.olparc;

import android.content.Context;
import android.graphics.Typeface;
import android.view.Gravity;
import android.widget.LinearLayout;
import android.widget.TextView;

public class LotStatus extends LinearLayout{

	public LotStatus(Context context, String name,String draw, String winningNumbers,String numbers,String win) {
		super(context);
		
		this.setOrientation(1);
		
		LinearLayout lay1=new LinearLayout(context);
		lay1.setOrientation(0);
		TextView lotName=new TextView(context);
		lotName.setText(name);
		lotName.setPadding(4, 4, 14, 4);
		lotName.setTextAppearance(context, android.R.style.TextAppearance_Medium);

		TextView drawN=new TextView(context);
		drawN.setText(draw);
		drawN.setPadding(4, 4, 14, 4);
		drawN.setTextAppearance(context, android.R.style.TextAppearance_Medium);
		TextView winnum=new TextView(context);
		winnum.setText(winningNumbers);
		winnum.setPadding(4, 4, 14, 4);
		winnum.setTextAppearance(context, android.R.style.TextAppearance_Medium);
		lay1.addView(lotName);
		lay1.addView(drawN);
		lay1.addView(winnum);
		
		LinearLayout lay2 = new LinearLayout(context);
		lay2.setOrientation(0);
		lay2.setGravity(Gravity.RIGHT);
		
		TextView nums = new TextView(context);
		nums.setText(numbers);
		nums.setPadding(4, 4, 4, 4);
		nums.setTextAppearance(context, android.R.style.TextAppearance_Medium);
		nums.setTypeface(null, Typeface.ITALIC);
		
		TextView wininng = new TextView(context);
		wininng.setText(win);
		wininng.setPadding(40, 4, 4, 4);
		wininng.setTextAppearance(context, android.R.style.TextAppearance_Medium);
		wininng.setTypeface(null, Typeface.ITALIC);
		lay2.addView(nums);
		lay2.addView(wininng);
		
		this.addView(lay1);
		this.addView(lay2);
		
		lay1.setBackgroundColor(0xaaeeeeee);
		lay2.setBackgroundColor(0xaaeeeeee);
		
		// TODO Auto-generated constructor stub
	}

}
