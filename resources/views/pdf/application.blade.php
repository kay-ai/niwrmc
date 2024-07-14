<!DOCTYPE html>
<html>
<head>
    <title>Application Details</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            line-height: 1.6;
            margin: 20px;
        }
        h2 {
            font-size: 18px;
            margin-bottom: 10px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
            text-align: left;
        }
    </style>
</head>
<body>
    <h2>Application Details</h2>
    <table>
        <tr>
            <th>Field</th>
            <th>Value</th>
        </tr>
        <tr>
            <td>Business Name</td>
            <td>{{ $applicationForm->business_name }}</td>
        </tr>
        <tr>
            <td>Business Location</td>
            <td>{{ $applicationForm->business_location }}</td>
        </tr>
        <tr>
            <td>Business Postal Address</td>
            <td>{{ $applicationForm->business_postal_address }}</td>
        </tr>
        <tr>
            <td>Business Phone Number</td>
            <td>{{ $applicationForm->business_phone_number }}</td>
        </tr>
        <tr>
            <td>Business Mobile Number</td>
            <td>{{ $applicationForm->business_mobile_number }}</td>
        </tr>
        <tr>
            <td>Business Email</td>
            <td>{{ $applicationForm->business_email }}</td>
        </tr>
        <tr>
            <td>Business Website</td>
            <td>{{ $applicationForm->business_website }}</td>
        </tr>
        <tr>
            <td>Legal Status</td>
            <td>{{ $applicationForm->legal_status }}</td>
        </tr>
        <tr>
            <td>Shareholders Criminal Status</td>
            <td>{{ $applicationForm->shareholders_criminal_status }}</td>
        </tr>
        <tr>
            <td>Shareholders Criminal Status Details</td>
            <td>{{ $applicationForm->shareholders_criminal_status_details }}</td>
        </tr>
        <tr>
            <td>Directors Criminal Status</td>
            <td>{{ $applicationForm->directors_criminal_status }}</td>
        </tr>
        <tr>
            <td>Directors Criminal Status Details</td>
            <td>{{ $applicationForm->directors_criminal_status_details }}</td>
        </tr>
        <tr>
            <td>License Sub Category</td>
            <td>{{ $applicationForm->license_sub_category->name }}</td>
        </tr>
        <tr>
            <td>Existing License</td>
            <td>{{ $applicationForm->existing_license }}</td>
        </tr>
        <tr>
            <td>Existing License Details</td>
            <td>{{ $applicationForm->existing_license_details }}</td>
        </tr>
        <tr>
            <td>Own 10% Share of Another Licensed Entity</td>
            <td>{{ $applicationForm->own_10_share_of_another_licensed_entity }}</td>
        </tr>
        <tr>
            <td>Share Licensed Entity Details</td>
            <td>{{ $applicationForm->share_licensed_entity_details }}</td>
        </tr>
        <tr>
            <td>Has Applicant Been Denied, Suspended, Cancelled?</td>
            <td>{{ $applicationForm->has_applicant_been_denied_suspended_cancelled }}</td>
        </tr>
        <tr>
            <td>Denied, Suspended, Cancelled Details</td>
            <td>{{ $applicationForm->denied_suspended_cancelled_details }}</td>
        </tr>
        <tr>
            <td>Share Capital of Applicant Authorized</td>
            <td>{{ $applicationForm->share_capital_of_applicant_authorized }}</td>
        </tr>
        <tr>
            <td>Share Capital of Applicant Fully Paid</td>
            <td>{{ $applicationForm->share_capital_of_applicant_fully_paid }}</td>
        </tr>
        <tr>
            <td>Certified Financial Statements URL</td>
            <td>{{ $applicationForm->certified_financial_statements_url }}</td>
        </tr>
        <tr>
            <td>Source of Funding (Share Capital)</td>
            <td>{{ $applicationForm->source_of_funding_share_capital }}</td>
        </tr>
        <tr>
            <td>Source of Funding (Loan Capital)</td>
            <td>{{ $applicationForm->source_of_funding_loan_capital }}</td>
        </tr>
        <tr>
            <td>Source of Funding (Others)</td>
            <td>{{ $applicationForm->source_of_funding_others }}</td>
        </tr>
        <tr>
            <td>Main Business Activity of Applicant</td>
            <td>{{ $applicationForm->main_business_activity_of_applicant }}</td>
        </tr>
        <tr>
            <td>Technical Capacity of Applicant</td>
            <td>{{ $applicationForm->technical_capacity_of_applicant }}</td>
        </tr>
        <tr>
            <td>Managerial Competence of Applicant</td>
            <td>{{ $applicationForm->managerial_competence_of_applicant }}</td>
        </tr>
        <tr>
            <td>Technical Support from Foreign Sources</td>
            <td>{{ $applicationForm->technical_support_from_foreign_sources }}</td>
        </tr>
        <tr>
            <td>Technical Support from Domestic Sources</td>
            <td>{{ $applicationForm->technical_support_from_domestic_sources }}</td>
        </tr>
        <tr>
            <td>Description of Proposed Project</td>
            <td>{{ $applicationForm->description_of_proposed_project }}</td>
        </tr>
        <tr>
            <td>Initial Capacity of Project</td>
            <td>{{ $applicationForm->initial_capacity_of_project }}</td>
        </tr>
        <tr>
            <td>Proposed Future Capacity of Project</td>
            <td>{{ $applicationForm->proposed_future_capacity_of_project }}</td>
        </tr>
        <tr>
            <td>Implementation Schedule of Project</td>
            <td>{{ $applicationForm->implementation_schedule_of_project }}</td>
        </tr>
        <tr>
            <td>Present Land Use at Project Site</td>
            <td>{{ $applicationForm->present_land_use_at_project_site }}</td>
        </tr>
        <tr>
            <td>Access to Public/Private Land</td>
            <td>{{ $applicationForm->is_there_access_to_public_private_land }}</td>
        </tr>
        <tr>
            <td>Covers Defense Ministry Area</td>
            <td>{{ $applicationForm->does_area_of_business_operation_cover_defense_ministry }}</td>
        </tr>
        <tr>
            <td>Covers River Basin DA Land</td>
            <td>{{ $applicationForm->does_area_of_business_operation_cover_river_basin_DA_land }}</td>
        </tr>
        <tr>
            <td>Environmental Impact of Project</td>
            <td>{{ $applicationForm->environmental_impact_of_project }}</td>
        </tr>
        <tr>
            <td>Geographic Area License is Required</td>
            <td>{{ $applicationForm->geographic_area_license_is_required }}</td>
        </tr>
        <tr>
            <td>Declaration by Applicant (Info is True)</td>
            <td>{{ $applicationForm->declaration_by_applicant_that_info_is_true }}</td>
        </tr>
    </table>
</body>
</html>
