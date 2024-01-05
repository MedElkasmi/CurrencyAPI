# Currency Information API

## Project Overview

This repository contains a currency information (Fake), application built with Laravel. It's designed to serve as a practical example for those new to API development and cloud deployment. The API allows clients to request and receive data on various countries' currencies and their performance over a six-month period.

## Key Features

- **Currency Database**: Stores detailed data about countries, their respective currencies, and monthly historical currency prices.
- **API Endpoint**: Offers a RESTful API endpoint for clients to request currency data by country name or code, providing the latest price and a six-month performance overview.
- **Performance Calculation**: Includes functionality to calculate and return insights into the currency's performance, such as average prices and percentage change.
- **Unit Testing**: Comes with comprehensive unit tests for model functionalities and data retrieval logic to ensure the API's reliability.
- **AWS Deployment**: The application has been successfully deployed to AWS, leveraging an EC2 instance for the application server and an RDS MySQL instance for the database.

## AWS Services Used

- **Amazon EC2**: Hosts the application, providing secure and resizable compute capacity in the cloud.
- **Amazon RDS**: Manages the MySQL database, offering scalable and reliable database services.

## Learning Resources

This project is ideal for beginners interested in:
- Building simple APIs with Laravel.
- Deploying applications using AWS services like EC2 and RDS.

## Contribution

Your feedback and contributions are welcome. If you have any suggestions or improvements, feel free to fork the repository and submit a pull request.

## License

This project is licensed under the [MIT License](LICENSE.md).
