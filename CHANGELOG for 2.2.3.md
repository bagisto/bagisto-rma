# CHANGELOG for v2.2.3

## **v2.2.3** (29th January 2025)- _Release_

+ Compatible with bagisto v2.2.3

+ After an RMA is created by the user, the admin should be restricted from generating the invoice, shipment, or refund.

+ Encountering an RMA issue with configurable products.

+ Facing a redirect issue when clicking on RMA â†’ Closed after the customer closes the RMA request.

+ When allowing RMA for a specific product, a message should be displayed on the New RMA Request pop-up page.

+ UI issues are observed on the RMA View page at 100% zoom on both the customer and admin sides.

+ Unable to select an option in the custom field type checkbox.

+ Once the RMA is canceled by a customer/guest, the cancel icon should not be displayed in the RMA list.

+ When the option "Allow New RMA Request for Declined Request" is enabled, the Reopen option should be displayed in the admin panel.

+ Running the Seeder command removes previously created RMAs from the customer end and regenerates new ones, whereas all RMAs remain visible in the admin panel.

+ Getting an attachment file URL issue when checking the attached file in the conversation section.

+ Please add a placeholder for RMA status on the Product Edit page.

+ In the Guest Panel, after completing an RMA request, clicking the Request New RMA button redirects the user to the customer login page URL instead.

+ When creating an RMA request from the Guest panel, the previously created RMA product should be removed from the New RMA Request page. The same behavior should apply to the customer panel.

+ In the RMA Rule section, rename the column "Rule Title" to "Reason".

+ Remove the "Allow New RMA Request for Pending Orders" section from the main configuration panel.

+ In the RMA Custom Fields section, the Required filter is not working and should be displayed as a drop-down field.

+ On the Customer End â†’ All RMA Page, the RMA status translation is missing, while the translation appears correctly on the RMA View page in the Arabic locale.

+ The product image is not displayed in the RMA Print section.

+ Translation is missing when sending messages in the Conversation section.

+ On the RMA Create page, the product name is not displayed, but after creating the RMA, the product name appears on the RMA View page.
+ Add the Seeder command in the README file.

+ The RMA status should remain consistent on the All RMA Requests page and the RMA Request View page on the customer end.

+ In RMA â†’ All RMA Section, the Customer Name filter is working for guest users.

+ In the Create RMA section, the heading should be displayed as the core heading format.

+ There is an alignment issue on the Admin â†’ Create RMA Request page.

+ The RMA Status section is displaying all default statuses.

+ In the Conversation section, when adding a WEBP attachment (while allowing only JPG/JPEG formats), the pop-up message appears  correctly, but the WEBP file is still being sent.

+ After creating an RMA Rule, the page should automatically refresh.

+ On the Create New RMA page, the Product Name is displayed in both Arabic and English.

+ There is a pop-up message issue on the Guest Login page.

## **v2.1.2** (22nd November 2024)- _Release_

+ Module is compatible with Bagisto V2.1.2.

+ Print RMA details feature has been added. 

+ The return/exchange window is now visible on the "New RMA" page when creating a new RMA.

+ Buyers and admins can communicate using the RMA system.

+ The Return Policy page is displayed to customers.

+ Admins can use the "Return Quantity" option to restock RMA quantities in their store.

+ Specific file extensions are now allowed in RMA configuration to support certain image types.

- Multiple critical bugs have been fixed.

- Issues related to flow and functionality of the RMA process have been resolved.

- UI-related issues have been fixed.

## **v2.0.x** - _Release_

- [compatibility] compatible bagisto v2.0.0

- [fixed] issues raised on git 

## **v1.4.4(22th of September, 2022)** - _Release_

- [compatibility] compatible bagisto v1.4.4

- [fixed] issues raised on git 

## **v1.3.3(10th of Jan, 2022)** - _Release_

- [compatible] Compatible with bagisto v1.3.2, v1.3.3
