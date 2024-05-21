package com.example.bpm;

import java.io.BufferedWriter;
import java.io.File;
import java.io.FileWriter;
import java.io.IOException;
import java.util.Random;

import javax.swing.JFileChooser;
import javax.swing.JOptionPane;
import javax.swing.plaf.FileChooserUI;

// import org.springframework.boot.SpringApplication;
// import org.springframework.boot.autoconfigure.SpringBootApplication;

// @SpringBootApplication
public class BpmApplication {

	public static void main(String[] args) {
		// SpringApplication.run(BpmApplication.class, args);

        File file = new File("C:/xampp/htdocs/read_pulse_data/bmp.txt");
		FileWriter writer = null;
		BufferedWriter buffw = null;

		String display = "";

		Random rng = new Random();
		final int START = 60, END = 90;
		int num = 0;

		try {
			

			Thread thread = Thread.currentThread();

			while(true) {
				thread.sleep(3000); //wait 3 seconds

				writer = new FileWriter(file);
				buffw = new BufferedWriter(writer);

				num = rng.nextInt(END - START + 1) + START;
				display = Integer.toString(num);
			
				//WRITE TO TEXT FILE
				// String display = JOptionPane.showInputDialog(null, "Enter pulse");
				
				buffw.write(display);

				System.out.println("is open: " + display);

				// buffw.newLine();

				buffw.close();
			}

		} catch(IOException ex) {
			System.err.println(ex.getMessage());
		} catch (InterruptedException e) {
			System.err.println(e.getMessage());
		} 
	}
}