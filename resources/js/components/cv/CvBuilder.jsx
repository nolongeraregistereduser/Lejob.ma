import React, { useState, useEffect } from 'react';
import CvForm from './CvForm';
import CvPreview from './CvPreview';
import { PDFDownloadLink } from '@react-pdf/renderer';
import CvPdfTemplate1 from './templates/CvPdfTemplate1';
import CvPdfTemplate2 from './templates/CvPdfTemplate2';
import axios from 'axios';

const CvBuilder = () => {
  const [formData, setFormData] = useState({
    name: '',
    titre: '',
    email: '',
    phone: '',
    education: '',
    experience: '',
    skills: '',
    certifications: '',
    languages: '',
    projects: '',
  });
  
  const [selectedTemplate, setSelectedTemplate] = useState('template1');
  const [loading, setLoading] = useState(false);
  const [saved, setSaved] = useState(false);

  useEffect(() => {
    // Load user data if editing an existing CV
    const fetchData = async () => {
      try {
        const response = await axios.get('/api/cv/current');
        if (response.data) {
          setFormData(response.data);
        }
      } catch (error) {
        console.error('Error fetching CV data', error);
      }
    };
    fetchData();
  }, []);

  const handleFormChange = (newData) => {
    setFormData(newData);
    setSaved(false);
  };

  const handleTemplateChange = (template) => {
    setSelectedTemplate(template);
  };

  const handleSave = async () => {
    setLoading(true);
    try {
      await axios.post('/api/cv', formData);
      setSaved(true);
    } catch (error) {
      console.error('Error saving CV', error);
    } finally {
      setLoading(false);
    }
  };

  const getSelectedPdfTemplate = () => {
    return selectedTemplate === 'template1' ? 
      <CvPdfTemplate1 formData={formData} /> : 
      <CvPdfTemplate2 formData={formData} />;
  };

  return (
    <div className="cv-builder container mx-auto p-4">
      <h1 className="text-3xl font-bold text-center mb-8">CV Builder</h1>
      
      <div className="flex flex-col lg:flex-row gap-6">
        <div className="lg:w-1/2">
          <CvForm 
            formData={formData} 
            onFormChange={handleFormChange} 
            onTemplateChange={handleTemplateChange}
            selectedTemplate={selectedTemplate}
          />
          
          <div className="mt-6 flex justify-between">
            <button 
              onClick={handleSave}
              disabled={loading}
              className="bg-blue-600 hover:bg-blue-700 text-white py-2 px-6 rounded-md transition duration-200"
            >
              {loading ? 'Saving...' : 'Save CV'}
            </button>
            
            <PDFDownloadLink 
              document={getSelectedPdfTemplate()} 
              fileName={`${formData.name.replace(/\s+/g, '_')}_CV.pdf`}
              className="bg-green-600 hover:bg-green-700 text-white py-2 px-6 rounded-md transition duration-200"
            >
              {({ loading }) => loading ? 'Generating PDF...' : 'Download PDF'}
            </PDFDownloadLink>
          </div>
          
          {saved && (
            <div className="mt-4 p-3 bg-green-100 text-green-700 rounded-md">
              CV saved successfully!
            </div>
          )}
        </div>
        
        <div className="lg:w-1/2 sticky top-6 bg-gray-50 rounded-lg shadow-lg overflow-hidden">
          <CvPreview formData={formData} template={selectedTemplate} />
        </div>
      </div>
    </div>
  );
};

export default CvBuilder;