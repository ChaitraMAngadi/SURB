<div class="container" style="margin: auto; width: 50%; padding: 10px; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2); border-radius: 5px; background-color: #fff; display: flex; flex-direction: column; align-items: center;">
    <h2 style="font-weight: bold; font-size: 24px; width: 100%; text-align: center;">Notification Preferences</h2>
    <form action="<?= base_url('vendors/notifications/notification_preferences'); ?>" method="post" style="width: 100%;">
        <div class="checkbox" style="margin-bottom: 20px;">
            <label style="font-size: 18px;"><input type="checkbox" id="select_all" name="preferences[all]" <?= !isset($preferences) || empty($preferences) || isset($preferences['all']) && $preferences['all'] ? 'checked' : ''; ?>> All Notifications</label>
        </div>
        <div class="checkbox" style="margin-bottom: 20px;">
            <label style="font-size: 18px;"><input type="checkbox" class="individual" name="preferences[order]" <?= isset($preferences['order']) && $preferences['order'] ? 'checked' : ''; ?>> Order Notifications</label>
        </div>
        <div class="checkbox" style="margin-bottom: 20px;">
            <label style="font-size: 18px;"><input type="checkbox" class="individual" name="preferences[payment]" <?= isset($preferences['payment']) && $preferences['payment'] ? 'checked' : ''; ?>> Payment Notifications</label>
        </div>
        <div class="checkbox" style="margin-bottom: 20px;">
            <label style="font-size: 18px;"><input type="checkbox" class="individual" name="preferences[delivery]" <?= isset($preferences['delivery']) && $preferences['delivery'] ? 'checked' : ''; ?>> Delivery Notifications</label>
        </div>
        
        <button type="submit" class="btn btn-primary" style="width: 100%; background-color: #007bff; color: white; padding: 10px 0; font-size: 16px; border-radius: 5px; border: none; cursor: pointer;">Save Preferences</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    const selectAllCheckbox = document.getElementById('select_all');
    const individualCheckboxes = document.querySelectorAll('.individual');

    // Function to handle the 'select all' behavior
    const handleSelectAll = () => {
        if (selectAllCheckbox.checked) {
            individualCheckboxes.forEach(checkbox => {
                checkbox.checked = false;
                checkbox.disabled = true;
            });
        } else {
            individualCheckboxes.forEach(checkbox => {
                checkbox.disabled = false;
            });
        }
    };

    // Initial call to handle the default state
    handleSelectAll();

    // Add event listeners to handle changes
    selectAllCheckbox.addEventListener('change', handleSelectAll);

    individualCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', () => {
            if (Array.from(individualCheckboxes).every(checkbox => !checkbox.checked)) {
                selectAllCheckbox.checked = true;
                handleSelectAll();
            } else {
                selectAllCheckbox.checked = false;
                selectAllCheckbox.disabled = false;
            }
        });
    });
});
</script>
