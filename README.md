# CloudFront

This is a ridiculously simple app to help integrate an [Elefant](http://www.elefantcms.com/)
website with the [Amazon CloudFront](http://aws.amazon.com/cloudfront/) content
distribution network (CDN).

## Setup

1\. Sign up for an [AWS account](http://aws.amazon.com/cloudfront/) and
add CloudFront to your services in the AWS Management Console.

2\. Still in the AWS Management Console, go to CloudFront and click the
`Create Distribution` button. Choose the following options in the Create
Distribution Wizard:

* Delivery Method: `Download`
* Distribution Type: `Custom Origin`
* Origin DNS Name: `www.example.com`

> Be sure to change `www.example.com` to match your website's domain name.

You can find more information about the other settings [here](http://docs.amazonwebservices.com/AmazonCloudFront/latest/DeveloperGuide/CreatingDistributions.html).
Now click Continue.

![Create Distribution Wizard](http://docs.amazonwebservices.com/AmazonCloudFront/latest/DeveloperGuide/images/CreateDistributionWiz.png)

3\. **Optional** Under Distribution Details, choose a subdomain like `cdn.example.com` and
enter it into the CNAMEs field. We'll be pointing this CNAME to CloudFront in
our DNS settings in a later step. For more info on the other settings,
[click here](http://docs.amazonwebservices.com/AmazonCloudFront/latest/DeveloperGuide/CreatingDistributions.html).

![Distribution Details](http://docs.amazonwebservices.com/AmazonCloudFront/latest/DeveloperGuide/images/CreateDistributionWiz2.png)

4\. **Optional** Once you've created your CloudFront distribution, copy the domain name shown
in the Domain Name tab. Log into your registrar and add a CNAME to your DNS as follows:

```
Subdomain         Record Type   IP or Domain
cdn.example.com   CNAME         d604721fxaaqy9.cloudfront.net
```

5\. Copy the `cloudfront` app into your Elefant install's `apps` folder. Edit the file
`apps/cloudfront/conf/config.php` and enter the Amazon AWS CDN domain name (from step 3)
into the `domain` field.

If you decided not to use a CNAME and skipped steps 3 and 4, simply copy the domain under
the Domain Name tab for your newly created CloudFront distribution and use that instead.

## Usage

In your views and layouts, any files you want to serve through CloudFront should be changed
to look like this:

```html
<img src="{! cloudfront/files/images/logo.png !}" />
```

The file path is simply wrapped in `{! !}` tags (the single spaces are optional and are
ignored), and the file path gets `cloudfront` added to it. This passes the file path to the
CloudFront app's main handler to be rewritten as a CloudFront reference.

